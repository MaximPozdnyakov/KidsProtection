<?php

/**
 * @api {get} /api/subscribes/list 1. Получить список подписок
 * @apiName GetSubscription
 * @apiGroup Subscription
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) {Array[subscriptions]} Success Список всех подписок
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 1,
 *         "name": "Small",
 *         "device": "3",
 *         "price": "199.0",
 *         "freeMonth": "1"
 *     },
 *     {
 *         "id": 2,
 *         "name": "Medium",
 *         "device": "5",
 *         "price": "249.0",
 *         "freeMonth": "1"
 *     },
 *     {
 *         "id": 3,
 *         "name": "Large",
 *         "device": "10",
 *         "price": "299.0",
 *         "freeMonth": "1"
 *     }
 * ]
 */

/**
 * @api {get} /api/subscriptions 2. Получить список подписок
 * @apiName GetSubscription
 * @apiGroup Subscription
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) {Array[subscriptions]} Success Список всех подписок авторизированного, истекших и активных.
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 4,
 *         "name": "Small",
 *         "price": "199.0",
 *         "free_month": "1",
 *         "start_dt": "07.09.2021 11:40",
 *         "end_dt": "07.01.2022 11:40",
 *         "user": "1",
 *         "created_at": "2021-09-07T11:40:39.000000Z",
 *         "updated_at": "2021-09-07T11:40:39.000000Z"
 *     },
 *     {
 *         "id": 5,
 *         "name": "Medium",
 *         "price": "249.0",
 *         "free_month": "0",
 *         "start_dt": "07.01.2022 11:40",
 *         "end_dt": "07.02.2022 11:40",
 *         "user": "1",
 *         "created_at": "2021-09-07T11:41:06.000000Z",
 *         "updated_at": "2021-09-07T11:41:06.000000Z"
 *     }
 * ]
 */

/**
 * @api {post} /api/subscriptions 2. Добавить подписку
 * @apiName PostSubscription
 * @apiGroup Subscription
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiParam {String} name Наименование подписки. Обязательный.
 * @apiParam {Integer} payed_num_of_months Количество оплаченных месяцев. В него не входят бесплатные месяцы. Если нужно активировать только бесплатный месяц, передавайте 0.
 *
 * @apiParamExample {json} Request:
 * {
 *     "name": "Medium",
 *     "payed_num_of_months": 3
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "name": [
 *            "Параметр name обязателен"
 *        ]
 *    }
 * }
 *
 * @apiError (Not Found 404) NotFound Возникает, при указании имени не существующей подписки
 * @apiErrorExample {json} Not Found 404:
 * {
 *    "message": "Не существует подписки с названием Extra Big",
 * }
 *
 * @apiSuccess (Success 200) Success Новая подписка и сообщение о ее создании
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Подписка добавлена",
 *     "data": {
 *         "id": 4,
 *         "name": "Small",
 *         "price": "199.0",
 *         "free_month": "1",
 *         "start_dt": "07.09.2021 11:40",
 *         "end_dt": "07.01.2022 11:40",
 *         "user": "1",
 *         "created_at": "2021-09-07T11:40:39.000000Z",
 *         "updated_at": "2021-09-07T11:40:39.000000Z"
 *     }
 * }
 */
