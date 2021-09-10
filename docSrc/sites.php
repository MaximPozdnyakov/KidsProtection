<?php
/**
 * @api {get} /websites/blocked 1. Получить список заблокированных сайтов указанного ребенка
 * @apiName GetSite
 * @apiGroup Site
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
 * @apiSuccess (Success 200) {Array[sites]} Success Список заблокированных сайтов
 * @apiSuccessExample {json} Success 200:
 * [
 *     "google.com",
 *     "youtube.com"
 * ]
 */

/**
 * @api {post} /api/websites/blocked 2. Заблокировать сайт
 * @apiName PostSite
 * @apiGroup Site
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} site Валидный хост или IP-адрес. Должен быть уникальным для ребенка. Обязательный.
 * @apiParam {String} child Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "site": "youtube.com",
 *     "child": "1"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "site": [
 *            "Параметр site обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение о блокировании сайта
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Сайт заблокирован"
 * }
 */

/**
 * @api {delete} /api/websites/blocked 3. Разблокировать сайт
 * @apiName DeleteSite
 * @apiGroup Site
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Сайт не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти сайт",
 * }
 *
 * @apiHeader {String} child Id ребенка
 * @apiHeader {String} site Заблокированный сайт
 * @apiHeaderExample {json} Header:
 * {
 *    "child": "1",
 *    "site": "google.com"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об разблокировки сайта
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Сайт разблокирован"
 * }
 */
