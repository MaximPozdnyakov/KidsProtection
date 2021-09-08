<?php
/**
 * @api {get} /api/calls/:child/:phone 1. Получить список звонков для указанного ребенка и телефона
 * @apiName GetCall
 * @apiGroup Call
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[calls]} Success Массив со списком звонков
 * @apiSuccessExample {json} Success 200:
 * /api/calls/1/79998887766
 * [
 *     {
 *         "id": 2,
 *         "phone": "79998887766",
 *         "locked": "1",
 *         "incoming": "1",
 *         "date": "07.09.2021 17:13",
 *         "user": "1",
 *         "created_at": "2021-09-07T16:54:42.000000Z",
 *         "updated_at": "2021-09-07T16:54:42.000000Z"
 *     }
 * ]
 */

/**
 * @api {post} /api/calls 2. Добавить звонок
 * @apiName PostCall
 * @apiGroup Call
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} phone Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр. Обязательный.
 * @apiParam {Boolean} incoming Является ли звонок входящим. Обязательный.
 * @apiParam {String} date Дата звонка в формате d.m.Y H:i. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "phone": "79998887766",
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
 * @apiSuccess (Success 200) Success Звонок с сообщением
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Звонок добавлен",
 *     "data": {
 *         "id": 2,
 *         "phone": "79998887766",
 *         "locked": "1",
 *         "incoming": "1",
 *         "date": "07.09.2021 17:13",
 *         "user": "1",
 *         "created_at": "2021-09-07T16:54:42.000000Z",
 *         "updated_at": "2021-09-07T16:54:42.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /calls/:child/:phone/:date 3. Получить список звонков для указанного ребенка по дате
 * @apiName GetCallByDate
 * @apiGroup Call
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * phone - Валидный номер телефона без спец символов, начинающийся с кода страны. Состоит из ровно 11 цифр.;
 * date - дата звонка в формате d.m.Y
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
 * @apiSuccess (Success 200) {Array[calls]} Success Массив звонков по указанной дате
 * @apiSuccessExample {json} Success 200:
 * /api/calls/1/79998887766/07.09.2021
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
 * @api {delete} /calls/:call 4. Удалить звонок
 * @apiName DeleteCall
 * @apiGroup Call
 * @apiVersion 1.0.0
 *
 * @apiDescription call - Id звонка
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Звонок не найден
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти звонков с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит звонков |
 *
 * @apiError (Not belong to your child 403) NotBelongToYourChild Попытка удалить звонок, не принадлежащий ребенку родителя
 * @apiErrorExample {json} Not belong to your child 403:
 * {
 *   "message": "Это звонков не принадлежит вашему ребенку"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении звонка
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Звонок был удален"
 * }
 */
