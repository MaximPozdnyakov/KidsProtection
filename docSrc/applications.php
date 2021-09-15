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
 * @api {post} /api/apps/object 2. Добавить приложение
 * @apiName PostApplication
 * @apiGroup Application
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} pack Идентификатор приложения. Должен быть уникальным для ребенка. Обязательный.
 * @apiParam {String} icon Ссылка на иконку приложения. Обязательный.
 * @apiParam {String} name Наименование приложения. Обязательный.
 * @apiParam {String} child Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "app": {
 *         "pack": "com.instagram.android",
 *         "name": "Instagram",
 *         "icon": "https://website.com/icon.png"
 *     },
 *     "child": "1"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "app.pack": [
 *            "Параметр app.pack обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Новое приложение
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 2,
 *     "name": "Instagram",
 *     "pack": "com.instagram.android",
 *     "icon": "https://website.com/icon.png"
 * }
 */

/**
 * @api {get} /api/apps/blocked 3. Получение списка заблокированных приложений
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
 * @apiSuccess (Success 200) {Object} Success Приложения
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "pack": "com.instagram.android",
 *         "limit": "120",
 *         "from": "0930",
 *         "to": "1900"
 *     },
 *     {
 *         "pack": "com.telegram.android",
 *         "limit": null,
 *         "from": "0930",
 *         "to": "1900"
 *     }
 * ]
 */

/**
 * @api {post} /api/apps/blocked 4. Заблокировать приложения
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
 * @api {delete} /api/apps/blocked 5. Разблокировать приложение
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
