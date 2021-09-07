<?php
/**
 * @api {get} /api/phones/:child 1. Получить список телефонов указанного ребенка
 * @apiName GetPhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[Phones]} Success Массив со списком телефонов
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 1,
 *         "phone": "79999999999",
 *         "locked": "1",
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-05T12:11:30.000000Z",
 *         "updated_at": "2021-09-05T12:11:30.000000Z"
 *     },
 * ]
 */

/**
 * @api {post} /api/phones 2. Записать телефон ребенка
 * @apiName PostPhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} phone Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр. Обязательный.
 * @apiParam {Boolean} locked Является ли телефон заблокированным. Необязательный. По умолчанию true.
 * @apiParam {String} user Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "phone": "79998887766",
 *     "locked": false,
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
 * @apiSuccess (Success 200) Success Сообщение с созданным телефоном
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Телефон добавлен",
 *     "data": {
 *         "id": 3,
 *         "phone": "79998887766",
 *         "locked": "0",
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-07T15:46:06.000000Z",
 *         "updated_at": "2021-09-07T15:46:06.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /phones/:child/:phone 3. Получить телефон
 * @apiName GetPhoneByDate
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * phone - Id телефона
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Object} Success Телефон
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 3,
 *     "phone": "79998887766",
 *     "locked": "0",
 *     "user": "1",
 *     "parent": "1",
 *     "created_at": "2021-09-07T15:46:06.000000Z",
 *     "updated_at": "2021-09-07T15:46:06.000000Z"
 * }
 */

/**
 * @api {patch} /phones/:phone 4. Обновить телефон
 * @apiName UpdatePhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiDescription phones - Id телефона
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Телефон не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти телефон с указанным id",
 * }
 *
 * @apiParam {Boolean} locked Является ли телефон заблокированным.
 * @apiParamExample {json} Request:
 * {
 *     "locked": true,
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит телефон |
 *
 * @apiSuccess (Success 200) Success Телефон и сообщение о его обновлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Настройки телефона обновлены",
 *     "data": {
 *         "id": 3,
 *         "phone": "79998887766",
 *         "locked": true,
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-07T15:46:06.000000Z",
 *         "updated_at": "2021-09-07T16:12:10.000000Z"
 *     }
 * }
 */

/**
 * @api {delete} /phones/:phone 5. Удалить телефон
 * @apiName DeletePhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiDescription phone - Id телефона
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Телефон не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти телефонов с указанным id",
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении телефона
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Телефон удален из списка телефонов"
 * }
 */
