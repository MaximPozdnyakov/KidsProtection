<?php
/**
 * @api {get} /api/sms/:child/:phone 1. Получить список смс для указанного ребенка и телефона
 * @apiName GetSms
 * @apiGroup Sms
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[sms]} Success Массив смс
 * @apiSuccessExample {json} Success 200:
 * /api/sms/1/79998887766
 * [
 *     {
 *         "id": 7,
 *         "phone": "79998887766",
 *         "msg": "Текст сообщения",
 *         "locked": "1",
 *         "incoming": "1",
 *         "date": "07.09.2021 17:13",
 *         "user": "1",
 *         "created_at": "2021-09-07T16:26:52.000000Z",
 *         "updated_at": "2021-09-07T16:26:52.000000Z"
 *     }
 * ]
 */

/**
 * @api {post} /api/sms 2. Добавить смс
 * @apiName PostSms
 * @apiGroup Sms
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} phone Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр. Обязательный.
 * @apiParam {String} msg Текст сообщения. Необязательный. По умолчанию null.
 * @apiParam {Boolean} incoming Является ли смс входящим. Обязательный.
 * @apiParam {String} date Дата отправки смс в формате d.m.Y H:i. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "phone": "79998887766",
 *     "msg": "Текст сообщения",
 *     "incoming": true,
 *     "date": "07.09.2021 17:13",
 *     "user": "1"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "phone": [
 *            "Параметр phone обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Not Found 404) NotFound Телефон не найден в списке телефонов ребенка
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Номер телефона 79998887766 не существует в списке номеров указанного ребенка",
 * }
 *
 * @apiSuccess (Success 200) Success Смс и сообщение о его добавлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Смс добавлено",
 *     "data": {
 *         "id": 7,
 *         "phone": "79998887766",
 *         "msg": "Текст сообщения",
 *         "locked": "1",
 *         "incoming": "1",
 *         "date": "07.09.2021 17:13",
 *         "user": "1",
 *         "created_at": "2021-09-07T16:26:52.000000Z",
 *         "updated_at": "2021-09-07T16:26:52.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /api/sms/:child/:phone/:date 3. Получить список смс для указанного ребенка по дате
 * @apiName GetSmsByDate
 * @apiGroup Sms
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.;
 * date - дата смс в формате d.m.Y
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Bad request 400) BadRequest Некорректная дата
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "Параметр date должен быть датой формата d.m.Y",
 * }
 *
 * @apiSuccess (Success 200) {Array[sms]} Success Массив смс по указанной дате
 * @apiSuccessExample {json} Success 200:
 * /api/sms/1/79998887766/07.09.2021
 * [
 *     {
 *         "id": 7,
 *         "phone": "79998887766",
 *         "msg": "Текст сообщения",
 *         "locked": "1",
 *         "incoming": "1",
 *         "date": "07.09.2021 17:13",
 *         "user": "1",
 *         "created_at": "2021-09-07T16:26:52.000000Z",
 *         "updated_at": "2021-09-07T16:26:52.000000Z"
 *     }
 * ]
 */

/**
 * @api {delete} /api/sms/:sms 4. Удалить смс
 * @apiName DeleteSms
 * @apiGroup Sms
 * @apiVersion 1.0.0
 *
 * @apiDescription sms - Id смс
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Смс не найдено
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти смс с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит смс |
 *
 * @apiError (Not belong to your child 403) NotBelongToYourChild Попытка удалить смс, не принадлежащее ребенку родителя
 * @apiErrorExample {json} Not belong to your child 403:
 * {
 *   "message": "Это смс не принадлежит вашему ребенку"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении смс
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Смс было удалено"
 * }
 */
