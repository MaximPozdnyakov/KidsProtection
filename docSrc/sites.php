<?php
/**
 * @api {get} /api/sites/:child 1. Получить список сайтов указанного ребенка
 * @apiName GetSite
 * @apiGroup Site
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка
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
 * @api {post} /api/sites 2. Добавить сайт
 * @apiName PostSite
 * @apiGroup Site
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} host Валидный хост или IP-адрес. Должен быть уникальным для ребенка. Обязательный.
 * @apiParam {Boolean} locked Является ли сайт заблокированным. Необязательный. По умолчанию true.
 * @apiParam {String} user Id ребенка. Обязательный.
 * @apiParam {String} start_dt Время начала доступа к сайту в формате d.m.Y H:i. Необязательный. По умолчанию null.
 * @apiParam {String} end_dt Время конца доступа к сайту в формате d.m.Y H:i. Необязательный. По умолчанию null.
 *
 * @apiParamExample {json} Request:
 * {
 *    "host": "google.com",
 *    "locked": false,
 *    "user": "1",
 *    "start_dt": "07.09.2021 17:13",
 *    "end_dt": "07.09.2021 19:13"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "channel": [
 *            "Параметр channel обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сайт и сообщение о его добавлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Сайт добавлен",
 *     "data": {
 *         "id": 1,
 *         "host": "google.com",
 *         "locked": "0",
 *         "start_dt": "07.09.2021 17:13",
 *         "end_dt": "07.09.2021 19:13",
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-08T12:09:35.000000Z",
 *         "updated_at": "2021-09-08T12:09:35.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /sites/:child/:site 3. Получить сайт
 * @apiName GetSiteById
 * @apiGroup Site
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * site - Id сайта
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Object} Success Сайт
 * @apiSuccessExample {json} Success 200:
 * /api/sites/1/1
 * {
 *    "id": 1,
 *    "host": "google.com",
 *    "locked": "0",
 *    "start_dt": "07.09.2021 17:13",
 *    "end_dt": "07.09.2021 19:13",
 *    "user": "1",
 *    "parent": "1",
 *    "created_at": "2021-09-08T12:09:35.000000Z",
 *    "updated_at": "2021-09-08T12:09:35.000000Z"
 * }
 */

/**
 * @api {patch} /sites/:site 4. Обновить настройки сайта
 * @apiName UpdateSite
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
 *    "message": "Не удалось найти сайт с указанным id",
 * }
 *
 * @apiParam {Boolean} locked Является ли сайт заблокированным.
 * @apiParam {String|null} start_dt Время начала доступа к сайту в формате d.m.Y H:i.
 * @apiParam {String|null} end_dt Время конца доступа к сайту в формате d.m.Y H:i.
 * @apiParamExample {json} Request:
 * {
 *     "locked": true,
 *     "start_dt": null,
 *     "end_dt": "07.09.2021 19:13"
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит сайт |
 *
 * @apiSuccess (Success 200) Success Сайт и сообщение о его обновлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Настройки сайта обновлены",
 *     "data": {
 *          "id": 1,
 *          "host": "google.com",
 *          "locked": "1",
 *          "start_dt": null,
 *          "end_dt": "07.09.2021 19:13",
 *          "user": "1",
 *          "parent": "1",
 *          "created_at": "2021-09-08T12:09:35.000000Z",
 *          "updated_at": "2021-09-08T12:09:35.000000Z"
 *     }
 * }
 */

/**
 * @api {delete} /sites/:site 5. Удалить сайт
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
