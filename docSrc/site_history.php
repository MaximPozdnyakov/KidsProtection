<?php
/**
 * @api {get} /api/site_history/:child/:host 1. Получить историю посещений сайта для указанного ребенка
 * @apiName GetSiteHistory
 * @apiGroup SiteHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * host - Валидный хост или IP-адрес.
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[site_history]} Success Массив с историей посещения сайта
 * @apiSuccessExample {json} Success 200:
 * /api/site_history/1/google.com
 * [
 *     {
 *         "id": 1,
 *         "host": "google.com",
 *         "locked": "1",
 *         "user": "1",
 *         "date": "07.09.2021 19:13",
 *         "created_at": "2021-09-08T12:54:05.000000Z",
 *         "updated_at": "2021-09-08T12:54:05.000000Z"
 *     }
 * ]
 */

/**
 * @api {post} /api/site_history 2. Добавить историю посещения сайта
 * @apiName PostSiteHistory
 * @apiGroup SiteHistory
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithChild
 * @apiUse WithSubscription
 *
 * @apiParam {String} host Валидный хост или IP-адрес. Обязательный.
 * @apiParam {String} user Id ребенка. Обязательный.
 * @apiParam {String} date Время захода на сайт в формате d.m.Y H:i.. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *    "host": "google.com",
 *    "user": "1",
 *    "date": "07.09.2021 19:13"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "host": [
 *            "Параметр host обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Not Found 404) NotFound Сайт не найден в списке сайтов ребенка
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Сайт не существует в списке сайтов указанного ребенка",
 * }
 *
 * @apiSuccess (Success 200) Success История посещения сайта и сообщение о ее создании
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История посещения сайта добавлена",
 *     "data": {
 *         "id": 1,
 *         "host": "google.com",
 *         "locked": "1",
 *         "user": "1",
 *         "date": "07.09.2021 19:13",
 *         "created_at": "2021-09-08T12:54:05.000000Z",
 *         "updated_at": "2021-09-08T12:54:05.000000Z"
 *     }
 * }
 */

/**
 * @api {get} /site_history/:child/:host/:date 3. Получить список посещений сайта для указанного ребенка по дате
 * @apiName GetSiteHistoryByDate
 * @apiGroup SiteHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription child - Id ребенка;
 * host - валидный хост или IP-адрес;
 * date - дата посещения сайта в формате d.m.Y
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
 * @apiSuccess (Success 200) {Array[site_history]} Success Массив с историей посещения сайта в указанный день
 * @apiSuccessExample {json} Success 200:
 * /api/site_history/1/google.com/07.09.2021
 * [
 *     {
 *         "id": 1,
 *         "host": "google.com",
 *         "locked": "1",
 *         "user": "1",
 *         "date": "07.09.2021 19:13",
 *         "created_at": "2021-09-08T12:54:05.000000Z",
 *         "updated_at": "2021-09-08T12:54:05.000000Z"
 *     }
 * ]
 */

/**
 * @api {delete} /site_history/:site_history 4. Удалить историю посещения сайта
 * @apiName DeleteSiteHistory
 * @apiGroup SiteHistory
 * @apiVersion 1.0.0
 *
 * @apiDescription site_history - Id истории посещения сайта
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiError (Not Found 404) NotFound История посещения сайта не найдена
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не удалось найти историю посещения сайта с указанным id",
 * }
 *
 * @apiPermission Пользователь, ребенку которого принадлежит история посещения сайта |
 *
 * @apiError (Not belong to your child 403) NotBelongToYourChild Попытка удалить историю посещения сайта, не принадлежащую ребенку родителя
 * @apiErrorExample {json} Not belong to your child 403:
 * {
 *   "message": "Эта история посещения сайта не принадлежит вашему ребенку"
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об удалении истории посещения сайта
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "История посещения сайта была удалена"
 * }
 */
