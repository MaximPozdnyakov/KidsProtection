<?php
/**
 * @api {get} /numberphones/blocked 1. Получить список заблокированных телефонов указанного ребенка
 * @apiName GetPhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 *     { "child": "1" }
 *
 * @apiSuccess (Success 200) {Array[sites]} Success Список заблокированных телефонов
 * @apiSuccessExample {json} Success 200:
 * [
 *     "+79998887766",
 *     "+79997776655",
 *     "+79996665544"
 * ]
 */

/**
 * @api {post} /api/numberphones/blocked 2. Заблокировать телефон
 * @apiName PostPhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} phone Валидный номер телефона, начинающийся с плюса и кода страны. Состоит из ровно 11 цифр. Должен быть уникальным для ребенка. Обязательный.
 * @apiParam {String} child Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "phone": "+79996665544",
 *     "child": "1"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "phone": [
 *            "Параметр phone обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о блокировании телефона
 * @apiSuccessExample {json} Success 200:
 * "Телефон заблокирован"
 */

/**
 * @api {delete} /api/numberphones/blocked 3. Разблокировать телефон
 * @apiName DeletePhone
 * @apiGroup Phone
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Телефон не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * "Не удалось найти телефон"
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} phone Заблокированный телефон
 * @apiHeaderExample {json} Header:
 * {
 *    "child": "1",
 *    "phone": "+79996665544"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об разблокировки телефона
 * @apiSuccessExample {json} Success 200:
 * "Телефон разблокирован"
 */
