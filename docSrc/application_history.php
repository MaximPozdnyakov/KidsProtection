<?php
/**
 * @api {post} /api/apps/story 2. Фиксация истории приложений
 * @apiName PostAppHistory
 * @apiGroup AppHistory
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
 * @apiParam {Integer} time Время использования приложения в минутах. Обязательный.
 * @apiParam {String} pack Идентификатор приложения. Обязательный.
 * @apiParam {String} date Дата начала использования приложения в формате d.m.Y H:i:s. Обязательный.
 *
 * @apiParamExample {json} Request:
 * [
 *     {
 *         "time": 120,
 *         "pack": "com.spotify.android",
 *         "date": "14.09.2021 00:00:00"
 *     }, {
 *         "time": 260,
 *         "pack": "com.instagram.android",
 *         "date": "12.09.2021 00:00:00"
 *     }, {
 *         "time": 320,
 *         "pack": "com.facebook.android",
 *         "date": "12.09.2021 10:00:00"
 *     }
 * ]
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "0.pack": [
 *            "Параметр 0.pack обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о добавлении истории
 * @apiSuccessExample {json} Success 200:
 * "Истории приложений зафиксированы"
 */

/**
 * @api {get} /api/apps/story 1. Получить историю приложений по дате
 * @apiName GetAppHistoryByDate
 * @apiGroup AppHistory
 * @apiVersion 1.0.0
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} date Дата использования приложения в формате d.m.Y
 * @apiHeaderExample {json} Header:
 * {
 *    "child": "1",
 *    "date": "12.09.2021"
 * }
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Bad request 404) BadRequest Некорректная дата
 * @apiErrorExample {json} Bad request 404:
 * "date должен быть датой формата d.m.Y"
 *
 * @apiSuccess (Success 200) {Array[app_history]} Success Список историй использования приложений по указанной дате
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "app": {
 *             "id": 2,
 *             "name": "Instagram",
 *             "pack": "com.instagram.android",
 *             "icon": "https://website.com/icon.png"
 *         },
 *         "time": "260"
 *     },
 *     {
 *         "app": {
 *             "id": 2,
 *             "name": "Facebook",
 *             "pack": "com.facebook.android",
 *             "icon": "https://website.com/icon.png"
 *         },
 *         "time": "320"
 *     }
 * ]
 */
