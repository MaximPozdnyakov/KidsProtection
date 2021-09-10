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
 * @apiSuccess (Success 200) {Array[sites]} Success Массив сайтов
 * @apiSuccessExample {json} Success 200:
 * /api/sites/1
 * [
 *     {
 *         "id": 1,
 *         "host": "google.com",
 *         "locked": "0",
 *         "start_dt": "07.09.2021 17:13",
 *         "end_dt": "07.09.2021 19:13",
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-08T12:09:35.000000Z",
 *         "updated_at": "2021-09-08T12:09:35.000000Z"
 *     },
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
 * @api {delete} /api/sites/:site 5. Удалить сайт
 * @apiName DeleteSite
 * @apiGroup Site
 * @apiVersion 1.0.0
 *
 * @apiDescription site - Id сайта
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Сайт не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти сайтов с указанным id",
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении сайта
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Сайт удален"
 * }
 */
