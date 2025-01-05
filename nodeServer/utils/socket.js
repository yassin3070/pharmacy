'use strict';
/**
 * after server connect config connector data
 * update socket id to user id with user type
 * listen and emit events
 */

// import helper file with sql helper funcs
const helper                     = require('./helper');
// const varaible
const { addressMedia, timeZone } = require("./constVariables");
// get models
const toolMessage                = require("./tools/messageTools");
// database info
const DB                         = require('./db');
// fcm info
const FCM_HELPER                 = require('./fcm');

// main variables
let users         = {};
let conversations = [];
class Socket {

    constructor(socket) {
        this.io = socket;
    }

    socketEvents() {
        this.io.on('connection', (socket) => {

            // connect socket
            socket.on('connect', data => {
                console.log(" welcome new user ==>" + socket.id)
            });

            // enter chat
            socket.on("enterChat", data => {
                console.log("enterChat ==>", data);
                let user = data.user_id + "_" + data.user_type;
                // check if user is online or not
                if (!(user in users)) {
                    users[user] = {};
                }

                users[user][data.room_id] = socket;
                socket.user_id            = user;
                socket.room_id            = data.room_id.toString();
            });

            //send message
            socket.on("sendMessage", data => {
                console.log('sendMessage ==>', data);
                // varaible
                var is_sender = 0, is_seen = 0;
                // get objForInsert
                let objInsert = toolMessage.objInsertMessage(data);
                // insert the message for get message_id
                let message   = helper.insertMessageAndUpdateRoom(objInsert);
                // create message relation for every room member
                let members   = helper.findAllMemberInRoom(data.room_id);

                let receiver  = data.receiver_id + "_" + data.receiver_type;
                //  find for all member
                members.then(function(result) {
                    if(result.length > 0) {
                        result.forEach(member => {
                           // insert into message_notification
                            message.then(function(id) {
                                is_sender = (data.sender_id.toString() == member.memberable_id.toString())?1:0;
                                is_seen   = (is_sender == 1) ? 1 : 0;
                                helper.insertMessageNotifications( data, id, member, is_sender, is_seen);
                            })
                        })
                     }
                })

                if (receiver in users) {
                    if (data.room_id in users[receiver]) {
                        message.then(function(id) {
                            let resResciverMessage = toolMessage.resRecieveMessage(data,id);
                            console.log('test' + resResciverMessage);
                            users[receiver][data.room_id].emit("sendMessageRes", resResciverMessage);
                        })
                    }
                }
                else {
                    // send fcm
                    FCM_HELPER.send(toolMessage.objFcm(data));
                }
            })

            // exit chat
            socket.on('exitChat', () => {
                console.log("exitChat");

                if (!(socket.user_id in users)) return;
                if (!(socket.room_id in users[socket.user_id])) return;
                delete users[socket.user_id][socket.room_id];
                if (Object.keys(users[socket.user_id]).length === 0) {
                    delete users[socket.user_id];
                }
            });

            // disconnect
            socket.on('disconnect', () => {
                console.log("disconnect");

                if (!(socket.user_id in users)) return;
                if (!(socket.room_id in users[socket.user_id])) return;
                delete users[socket.user_id][socket.room_id];
                if (Object.keys(users[socket.user_id]).length === 0) {
                    delete users[socket.user_id];
                }
            });

        });
    }

    // config connector data
    socketConfig() {
        console.log('you can start socket events');
        this.socketEvents();
    }
}

module.exports = Socket;