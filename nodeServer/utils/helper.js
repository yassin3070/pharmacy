'user strict';

/**
 * mysql queries helper functions
 */

const DB = require('./db');

// const fs = require('fs');

class Helper {

    constructor(app) {
        this.db = DB;
    }

    // insert message of room and update by last_message_id
    insertMessageAndUpdateRoom(data) {
        try{
            // obj need ==> { room_id - sender_id - sender_type - type - body - duration - created_at
            return new Promise(function (resolve, reject) {
                DB.query('INSERT INTO messages SET ?', data).then((results,error) => {
                    // update room last_message_id and date
                    DB.query('UPDATE rooms SET ? WHERE id = ?', [{last_message_id:results.insertId,updated_at:new Date()},data.room_id]);
                    // return result
                    resolve(results.insertId);
                });
            });
        } catch (error) {
                console.log(error);
                return null;
        }
    }

    // find all row of table room_members
    findAllMemberInRoom(room_id){
        try{
            return new Promise(function (resolve, reject) {
                DB.query("SELECT * From room_members Where room_id = "+ room_id).then((members,error) =>{
                    console.log("members123==<",members)
                    return resolve(members);
                })
            });
        } catch (error) {
            console.log(error);
            return null;
        }
    }

    // insert row of table message_notifications
    insertMessageNotifications(data,message_id,member,is_sender,is_seen){
        try{
            return new Promise(function (resolve, reject) {
                console.log("is_sender",is_sender)
                DB.query('INSERT INTO message_notifications SET ?', {room_id: data.room_id,message_id: message_id,userable_type:member.memberable_type,userable_id:member.memberable_id,is_flagged:0,is_sender:is_sender,is_seen:is_seen,created_at:new Date()});
            });
        } catch (error) {
            console.log(error);
            return null;
        }

    }

    addSocketId(userId, userSocketId) {
        // try {
        //     return await this.db.query(`UPDATE users SET socket_id = ?, online= ? WHERE id = ?`, [userSocketId, '1', userId]);
        // } catch (error) {
        //     console.log(error);
        //     return null;
        // }
    }

    logoutUser(userSocketId) {
        // try {
        //     return await this.db.query(`UPDATE users SET socket_id = ?, online= ? WHERE id = ?`, ['', '0', userSocketId]);
        // } catch (error) {
        //     console.warn(error);
        //     return null;
        // }

    }

    isUserConnected(userId) {
        // try {
        //     return Promise.all([
        //         this.db.query(`SELECT id, name, socket_id, online, updated_at FROM users WHERE id = ?`, [userId])
        //     ]).then((response) => {
        //         return {
        //             userData: response[0]
        //         };
        //     }).catch((error) => {
        //         console.warn(error);
        //         console.log(1111);
        //         return (null);
        //     });
        // } catch (error) {
        //     console.warn(error);
        //     return null;
        // }
    }

    updateDriverLocation(req, driverId) {
        // console.log('update driver location helper:', req, driverId)
        // try {
        //     this.db.query(`UPDATE drivers SET lat = ?, lng= ? WHERE id = ?`, [req.lat, req.lng, driverId]);
        //     return;
        // } catch (error) {
        //     console.warn(error);
        //     return null;
        // }
    }

    getDriverLocation(driverId) {
        // try {
        //     return Promise.all([
        //         this.db.query(`SELECT id, lat, lng
        //                FROM drivers
        //                WHERE id = ?`, [driverId])
        //     ]).then((response) => {
        //         return {
        //             driverData: response[0]
        //         };
        //     }).catch((error) => {
        //         console.warn(error);
        //         return (null);
        //     });
        // } catch (error) {
        //     console.warn(error);
        //     return null;
        // }
    }
}

module.exports = new Helper();