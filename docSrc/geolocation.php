<?php
/**
 * @api {get} /api/geolocation/:child 1. Получить список геолокаций для указанного ребенка
 * @apiName GetGeolocation
 * @apiGroup Geolocation
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[geolocation]} Success Массив со списком геолокаций
 * @apiSuccessExample {json} Success 200:
 * [
 *    {
 *        "id": 1,
 *        "latitude": "59.837271",
 *        "longitude": "30.312033",
 *        "address": null,
 *        "date": "05.09.2021 17:40",
 *        "user": "1",
 *        "created_at": "2021-09-05T14:46:06.000000Z",
 *        "updated_at": "2021-09-05T14:46:06.000000Z"
 *    },
 * ]
 */

/**
 * @api {post} /api/geolocation 2. Записать геолокацию ребенка
 * @apiName PostGeolocation
 * @apiGroup Geolocation
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} latitude Валидная широта. Обязательный.
 * @apiParam {String} longitude Валидная долгота. Обязательный.
 * @apiParam {String} address Адрес. Необязательный. По умолчанию null.
 * @apiParam {String} date Дата отправки геолокации в формате d.m.Y H:i. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "latitude": "79.837271",
 *     "longitude": "30.312033",
 *     "address": "адрес",
 *     "date": "07.09.2021 17:13",
 *     "user": "1"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "latitude": [
 *            "Параметр latitude обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение с созданной геолокацией
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Геолокация добавлена",
 *     "data": {
 *         "id": 5,
 *         "latitude": "79.837271",
 *         "longitude": "30.312033",
 *         "address": "адрес",
 *         "date": "07.09.2021 17:13",
 *         "user": "1",
 *         "created_at": "2021-09-07T15:08:19.000000Z",
 *         "updated_at": "2021-09-07T15:08:19.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /geolocation/:child/:date 3. Получить список геолокация для указанного ребенка по дате
 * @apiName GetGeolocationByDate
 * @apiGroup Geolocation
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * date - дата записи геолокации в формате d.m.Y
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiError (Bad request 400) BadRequest Некорректная дата
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "Параметр date должен быть датой формата d.m.Y",
 * }
 *
 * @apiSuccess (Success 200) {Array[geolocation]} Success Массив со списком геолокаций по указанной дате
 * @apiSuccessExample {json} Success 200:
 * /api/geolocation/1/05.09.2021
 * [
 *    {
 *        "id": 1,
 *        "latitude": "59.837271",
 *        "longitude": "30.312033",
 *        "address": null,
 *        "date": "05.09.2021 17:40",
 *        "user": "1",
 *        "created_at": "2021-09-05T14:46:06.000000Z",
 *        "updated_at": "2021-09-05T14:46:06.000000Z"
 *    },
 * ]
 */

/**
 * @api {delete} /geolocation/:geolocation 4. Удалить геолокацию
 * @apiName DeleteGeolocation
 * @apiGroup Geolocation
 * @apiVersion 1.0.0
 *
 * @apiDescription geolocation - Id геолокации
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound Геолокация не найдена
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти геолокацию с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит геолокация |
 *
 * @apiError (Not belong to your child 403) NotBelongToYourChild Попытка удалить геолокацию, не принадлежащую ребенку родителя
 * @apiErrorExample {json} Not belong to your child 403:
 * {
 *   "message": "Эта геолокация не принадлежит вашему ребенку"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении геолокации
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Геолокация была удалена"
 * }
 */
