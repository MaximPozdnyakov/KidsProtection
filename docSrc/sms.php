<?php
/**
 * @api {post} /api/numberphones/story 2. Добавить звонки и смс ребенка
 * @apiName PostCallsAndSms
 * @apiGroup CallsAndSms
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} phone Валидный номер телефона, начинающийся с + и кода страны. Состоит из ровно 11 цифр. Обязательный.
 * @apiParam {Boolean} input Является ли смс или звонок входящим. Обязательный.
 * @apiParam {Boolean} isCall Является звонком или смс. Обязательный.
 * @apiParam {String} message Текст смс. Необязательный. По умолчанию null.
 * @apiParam {String} date Дата отправки смс или звонка в формате d.m.Y H:i:s. Обязательный.
 * @apiParam {String} child Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "child": "1",
 *     "phones":
 *         [
 *             {
 *                 "date": "07.09.2021 13:33:21",
 *                 "phone": "+79998887744",
 *                 "input": true,
 *                 "isCall": true,
 *                 "msg": ""
 *             },
 *             {
 *                 "date": "07.09.2021 16:33:22",
 *                 "phone": "+79998887734",
 *                 "input": true,
 *                 "isCall": false,
 *                 "msg": "Новое сообщение"
 *             }
 *         ]
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "phones.0.phone": [
 *            "Параметр phones.0.phone обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о добавлении звонков и смс
 * @apiSuccessExample {json} Success 200:
 * "Звонки и смс добавлены"
 */

/**
 * @api {get} /api/numberphones/story 1. Получить список звонков и смс для указанного ребенка по дате
 * @apiName GetCallsAndSmsByDate
 * @apiGroup CallsAndSms
 * @apiVersion 1.0.0
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} date Дата добавления звонков и смс в формате d.m.Y
 * @apiHeaderExample {json} Header:
 * {
 *    "child": "1",
 *    "date": "07.09.2021"
 * }
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Bad request 404) BadRequest Некорректная дата
 * @apiErrorExample {json} Bad request 404:
 * "message": "date должен быть датой формата d.m.Y"
 *
 * @apiSuccess (Success 200) {Array[geolocation]} Success Массив звонков и смс по указанной дате
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "phone": "+79998887744",
 *         "input": "1",
 *         "isCall": "1",
 *         "message": null,
 *         "date": "07.09.2021 13:33:21"
 *     },
 *     {
 *         "phone": "+79998887734",
 *         "input": "1",
 *         "isCall": "0",
 *         "message": "Новое сообщение",
 *         "date": "07.09.2021 16:33:22"
 *     }
 * ]
 */
