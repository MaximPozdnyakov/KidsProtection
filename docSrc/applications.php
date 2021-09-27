<?php
/**
 * @api {get} /api/apps/list 1. Получение списка выбора приложений с подгрузкой
 * @apiName GetApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiDescription Возвращает список из 20 элементов приложений. Чтобы получить следующие 20 элементов необходимо передать в заголовке параметр "last" с идентификатором последнего полученного приложения. Запрос с заголовком "last": "null" вернёт первые 20 элементов таблицы приложений.
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} last Id последнего приложения
 * @apiHeaderExample {json} Header:
 * {
 * "child": "1",
 * "last": "2"
 * }
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[applications]} Success Массив приложений
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 3,
 *         "name": "Facebook",
 *         "pack": "com.facebook.android",
 *         "icon": "https://website.com/icon.png"
 *     },
 *     {
 *         "id": 4,
 *         "name": "Telegram",
 *         "pack": "com.telegram.android",
 *         "icon": "https://website.com/icon.png"
 *     }
 * ]
 */

/**
 * @api {get} /api/apps/blocked 2. Получение списка заблокированных приложений
 * @apiName GetApplicationById
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 * {
 * "child": "1",
 * }
 *
 * @apiSuccess (Success 200) {Array} Success Приложения
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 4,
 *         "name": "Telegram",
 *         "pack": "com.telegram.android",
 *         "icon": "https://website.com/new-icon.png"
 *     },
 *     {
 *         "id": 15,
 *         "name": "Instagram",
 *         "pack": "com.instagram.android",
 *         "icon": "https://website.com/instagram.png"
 *     },
 *     {
 *         "id": 18,
 *         "name": "Spotify",
 *         "pack": "com.spotify.android",
 *         "icon": "https://website.com/icon.png"
 *     }
 * ]
 */

/**
 * @api {post} /api/apps/blocked 3. Заблокировать приложения
 * @apiName UpdateApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Приложение не найдено или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * "Приложения с таким названием не существует в списке приложений указанного ребенка"
 *
 * @apiParam {String} child Id ребенка. Обязательный.
 * @apiParam {String} pack Идентификатор приложения. Обязательный.
 * @apiParam {Integer|null} limit Лимит в минутах на использование приложения в день.
 * @apiParam {String|null} from Время начала использования приложения.
 * @apiParam {String|null} to Время конца использования приложения.
 *
 * @apiParamExample {json} Request:
 * {
 *     "child": "1",
 *     "app": {
 *         "pack": "com.telegram.android",
 *         "limit": 120,
 *         "from": "0930",
 *         "to": "1900"
 *     }
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит приложение |
 *
 * @apiSuccess (Success 200) Success Сообщение о блокировании приложения
 * @apiSuccessExample {json} Success 200:
 * "Приложение заблокировано"
 */

/**
 * @api {delete} /api/apps/blocked 4. Разблокировать приложение
 * @apiName DeleteApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} app Id приложения
 * @apiHeaderExample {json} Header:
 * {
 * "child": "1",
 * "app": "2"
 * }
 *
 * @apiError (Not Found 404) NotFound Приложение не найдено или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * "Не удалось найти приложений с указанным id"
 *
 * @apiPermission Пользователь, ребенку которого принадлежит приложение |
 *
 * @apiSuccess (Success 200) Success Сообщение о разблокировке приложения
 * @apiSuccessExample {json} Success 200:
 * "Приложение разблокировано"
 */

/**
 * @api {post} /api/apps/sync 5. Синхронизация приложений ребёнка
 * @apiName SyncApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiDescription Приложение удаляется, если его нет в теле запроса, обновляется, если оно есть в теле запроса. Если в теле запроса есть приложение, которого нет в базе, оно добавляется в базу.
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 * {
 * "child": "1",
 * }
 *
 * @apiParam {String} pack Идентификатор приложения. Обязательный.
 * @apiParam {String} name Имя приложения. Обязательный.
 * @apiParam {String} icon Иконка приложения. Обязательный.
 *
 * @apiParamExample {json} Request:
 * [
 *     {
 *         "name": "Kids Protection",
 *         "pack": "kids.protection.app",
 *         "icon": "Base64"
 *     },
 *     {
 *         "name": "Instagram",
 *         "pack": "com.instagram.android",
 *         "icon": "Base64"
 *     }
 * ]
 *
 * @apiSuccess (Success 200) Success Сообщение о синхронизации приложений
 * @apiSuccessExample {json} Success 200:
 * "Приложения синхронизированы"
 */

/**
 * @api {get} /api/apps/child 6. Получение списка всех приложений
 * @apiName GetAllApplications
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 * {
 * "child": "1",
 * }
 *
 * @apiSuccess (Success 200) {Array} Success Приложения
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 4,
 *         "name": "Telegram",
 *         "pack": "com.telegram.android",
 *         "icon": "https://website.com/new-icon.png"
 *     },
 *     {
 *         "id": 15,
 *         "name": "Instagram",
 *         "pack": "com.instagram.android",
 *         "icon": "https://website.com/instagram.png"
 *     },
 *     {
 *         "id": 18,
 *         "name": "Spotify",
 *         "pack": "com.spotify.android",
 *         "icon": "https://website.com/icon.png"
 *     }
 * ]
 */

/**
 * @api {put} /api/apps/blocked 7. Заблокировать несколько приложений
 * @apiName BlockManyApplications
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiParam {String} child Id ребенка. Обязательный.
 * @apiParam {Array} packs Массив идентификаторов приложений. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "child": "1",
 *     "packs":
 *         [
 *             "com.instagram.android",
 *             "com.test.app"
 *         ]
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о блокировании приложений
 * @apiSuccessExample {json} Success 200:
 * "Приложения заблокированы"
 */

/**
 * @api {get} /api/apps/child 8. Получение списка ограниченных приложений
 * @apiName GetLimitedApplications
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeaderExample {json} Header:
 * {
 * "child": "1",
 * }
 *
 * @apiSuccess (Success 200) {Array} Success Приложения
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "limit": null,
 *         "from": "0930",
 *         "to": "1900",
 *         "app": {
 *             "id": 4,
 *             "name": "Telegram",
 *             "pack": "com.telegram.android",
 *             "icon": "https://website.com/new-icon.png"
 *         }
 *     },
 *     {
 *         "limit": 60,
 *         "from": null,
 *         "to": null,
 *         "app": {
 *             "id": 15,
 *             "name": "Instagram",
 *             "pack": "com.instagram.android",
 *             "icon": "https://website.com/instagram.png"
 *         }
 *     },
 *     {
 *         "limit": 0,
 *         "from": null,
 *         "to": null,
 *         "app": {
 *             "id": 18,
 *             "name": "Spotify",
 *             "pack": "com.spotify.android",
 *             "icon": "https://website.com/icon.png"
 *         }
 *     }
 * ]
 */
