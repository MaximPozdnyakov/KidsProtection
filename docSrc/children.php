<?php

/**
 * @api {get} /api/child/list 1. Получить список детей
 * @apiName GetChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[children]} Success Список детей авторизированного пользователя. Их число ограничено текущей подпиской. К примеру, у пользователя была подключена подписка с 5 устройствами, и он зарегистрировал 5 детей. Но потом она истекла, и он подключил подписку дешевле, на 3 устройства. Тогда этот метод вернет первых трех детей из пяти.
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 1,
 *         "name": "Вова",
 *         "year": "2014",
 *         "parent": "2",
 *         "allowedTimeOfAppsUse": null
 *     },
 *     {
 *         "id": 2,
 *         "name": "Юля",
 *         "year": "2014",
 *         "parent": "2"
 *         "allowedTimeOfAppsUse": null
 *     }
 * ]
 */

/**
 * @api {post} /api/child/object 2. Добавить ребенка
 * @apiName PostChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiParam {String} name Имя ребенка. Обязательный.
 * @apiParam {Integer} year Год рождения ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "child": {
 *         "name": "Вова",
 *         "year": 2014
 *     }
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "child.name": [
 *            "Параметр child.name обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Devices Limit Reached 404) DevicesLimitReached Возникает при попытке добавить больше устройств, чем позволяет подписка
 * @apiErrorExample {json} Devices Limit Reached 404:
 * {
 *    "message": "Вам можно подключить не более 3 устройств",
 * }
 *
 * @apiSuccess (Success 200) Success Новый ребенок
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 2,
 *     "name": "Юля",
 *     "year": "2014",
 *     "parent": "2",
 *     "allowedTimeOfAppsUse": null
 * }
 */

/**
 * @api {get} /api/child/object 3. Получить ребенка
 * @apiName GetOneChild
 * @apiGroup Child
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
 * @apiSuccess (Success 200) {Object} Success Ребенок
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 1,
 *     "name": "Вова",
 *     "year": "2014",
 *     "parent": "2",
 *     "allowedTimeOfAppsUse": null
 * }
 */

/**
 * @api {put} /api/child/object 4. Обновить данные ребенка
 * @apiName UpdateChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} id Id ребенка.
 * @apiParam {String} name Имя ребенка.
 * @apiParam {Integer} year Год рождения ребенка
 * @apiParam {String} allowedTimeOfAppsUse Ограничение на время использования приложений в день, в формате hh:mm, по умолчанию null
 *
 * @apiParamExample {json} Request:
 * {
 *     "child": {
 *         "id": "1",
 *         "name": "Вадим",
 *         "year": 2015,
 *         "allowedTimeOfAppsUse": "04:00"
 *     }
 * }
 *
 * @apiSuccess (Success 200) Success Обновленный ребенок
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 1,
 *     "name": "Вадим",
 *     "year": 2015,
 *     "parent": "2",
 *     "allowedTimeOfAppsUse": "04:00"
 * }
 */

/**
 * @api {delete} /api/child/object 5. Удалить ребенка
 * @apiName DeleteChild
 * @apiGroup Child
 * @apiVersion 1.0.0
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 *     { "child": "1" }
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении ребенка
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Ребенок удален"
 * }
 */
