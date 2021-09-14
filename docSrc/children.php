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
 *         "year": "2014"
 *     },
 *     {
 *         "id": 2,
 *         "name": "Юля",
 *         "year": "2014"
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
 * "Вам можно подключить не более 3 устройств"
 *
 * @apiSuccess (Success 200) Success Новый ребенок
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 2,
 *     "name": "Юля",
 *     "year": "2014"
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
 *     "allApps": {
 *         "allAppsLock": "0",
 *         "allAppsLimit": null,
 *         "allAppsStartTime": null,
 *         "allAppsFinishTime": null
 *     }
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
 *     "year": 2015
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
 * "Ребенок удален"
 */

/**
 * @api {post} /api/child/allapps 6. Установить/снять ограничение на все приложения
 * @apiName UpdateChildApps
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
 * @apiParam {Boolean} allAppsLock Все приложения заблокированы.
 * @apiParam {Integer|null} allAppsLimit Лимит в минутах на использование приложений.
 * @apiParam {String|null} allAppsStartTime Разрешенное время начала использования приложений.
 * @apiParam {String|null} allAppsFinishTime Разрешенное время конца использования приложений.
 *
 * @apiParamExample {json} Request:
 * {
 *     "allAppsLock": true,
 *     "allAppsLimit": 120,
 *     "allAppsStartTime": "0930",
 *     "allAppsFinishTime": "1900"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об обновлении ограничений на приложения
 * @apiSuccessExample {json} Success 200:
 * "Настройки приложений обновлены"
 */
