<?php
/**
 * @api {get} /api/youtube/:child 1. Получить список youtube каналов указанного ребенка
 * @apiName GetYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[youtube]} Success Массив youtube каналов
 * @apiSuccessExample {json} Success 200:
 * /api/youtube/1
 * [
 *     {
 *         "id": 1,
 *         "channel": "maxkatz1",
 *         "locked": "1",
 *         "start_dt": "07.09.2021 17:13",
 *         "end_dt": "07.09.2021 19:13",
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-08T07:46:56.000000Z",
 *         "updated_at": "2021-09-08T07:46:56.000000Z"
 *     },
 * ]
 */

/**
 * @api {post} /api/youtube 2. Добавить youtube канал
 * @apiName PostYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} channel Идентификатор канала или ссылка на него. Должен быть уникальным для ребенка. Обязательный. Нельзя добавить идентификатор канала и ссылку, относящиеся к одному каналу. К примеру, если в базе уже создана сущность с channel=https://www.youtube.com/c/maxkatz1 , то при добавлении сущности с channel=maxkatz1 , метод выдаст ошибку.
 * @apiParam {Boolean} locked Является ли youtube канал заблокированным. Необязательный. По умолчанию true.
 * @apiParam {String} user Id ребенка. Обязательный.
 * @apiParam {String} start_dt Время начала доступа к каналу в формате d.m.Y H:i. Необязательный. По умолчанию null.
 * @apiParam {String} end_dt Время конца доступа к каналу в формате d.m.Y H:i. Необязательный. По умолчанию null.
 *
 * @apiParamExample {json} Request:
 * {
 *     "channel": "maxkatz1",
 *     "locked": false,
 *     "user": "1",
 *     "start_dt": "07.09.2021 17:13",
 *     "end_dt": "07.09.2021 19:13"
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
 * @apiSuccess (Success 200) Success Youtube канал и сообщение о его добавлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Youtube канал добавлен",
 *     "data": {
 *         "id": 1,
 *         "channel": "maxkatz1",
 *         "locked": "1",
 *         "start_dt": "07.09.2021 17:13",
 *         "end_dt": "07.09.2021 19:13",
 *         "user": "1",
 *         "parent": "1",
 *         "created_at": "2021-09-08T07:46:56.000000Z",
 *         "updated_at": "2021-09-08T07:46:56.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /youtube/:child/:youtube 3. Получить youtube канал
 * @apiName GetYoutubeById
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * youtube - Id youtube канала
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Object} Success Youtube канал
 * @apiSuccessExample {json} Success 200:
 * /api/youtube/1/1
 * {
 *    "id": 1,
 *    "channel": "maxkatz1",
 *    "locked": "1",
 *    "start_dt": "07.09.2021 17:13",
 *    "end_dt": "07.09.2021 19:13",
 *    "user": "1",
 *    "parent": "1",
 *    "created_at": "2021-09-08T07:46:56.000000Z",
 *    "updated_at": "2021-09-08T07:46:56.000000Z"
 * }
 */

/**
 * @api {patch} /youtube/:youtube 4. Обновить youtube канал
 * @apiName UpdateYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiDescription youtube - Id youtube канала
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Youtube канал не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти youtube канал с указанным id",
 * }
 *
 * @apiParam {Boolean} locked Является ли youtube канал заблокированным.
 * @apiParam {String|null} start_dt Время начала доступа к каналу в формате d.m.Y H:i.
 * @apiParam {String|null} end_dt Время конца доступа к каналу в формате d.m.Y H:i.
 * @apiParamExample {json} Request:
 * {
 *     "locked": false,
 *     "start_dt": null,
 *     "end_dt": "07.09.2021 19:13"
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит youtube канал |
 *
 * @apiSuccess (Success 200) Success Youtube канал и сообщение о его обновлении
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Настройки youtube канала обновлены",
 *     "data": {
 *          "id": 1,
 *          "channel": "maxkatz1",
 *          "locked": 0,
 *          "start_dt": null,
 *          "end_dt": "07.09.2021 19:13",
 *          "user": "1",
 *          "parent": "1",
 *          "created_at": "2021-09-08T07:46:56.000000Z",
 *          "updated_at": "2021-09-08T07:46:56.000000Z"
 *     }
 * }
 */

/**
 * @api {delete} /youtube/:youtube 5. Удалить youtube канал
 * @apiName DeleteYoutube
 * @apiGroup Youtube
 * @apiVersion 1.0.0
 *
 * @apiDescription youtube - Id youtube канала
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Youtube канал не найден или не принадлежит ребенку пользователя
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти youtube каналов с указанным id",
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении youtube канала
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Youtube канал удален"
 * }
 */
