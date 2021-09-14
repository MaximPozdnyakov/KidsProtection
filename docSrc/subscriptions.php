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
 * @api {get} /api/user/subscribe 3. Получить подписки, одна из них будет или нет, с признаком активности
 * @apiName GetSubscriptionWithActive
 * @apiGroup Subscription
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 * @apiUse WithSubscription
 *
 * @apiSuccess (Success 200) {Array[subscriptions]} Success Список всех подписок авторизированного, истекших и активных.
 * @apiSuccessExample {json} Success 200:
 * [
 *     {
 *         "id": 1,
 *         "name": "Small",
 *         "device": "3",
 *         "price": "199.0",
 *         "freeMonth": "1",
 *         "active": false
 *     },
 *     {
 *         "id": 2,
 *         "name": "Medium",
 *         "device": "5",
 *         "price": "249.0",
 *         "freeMonth": "1",
 *         "active": true
 *     },
 *     {
 *         "id": 3,
 *         "name": "Large",
 *         "device": "10",
 *         "price": "299.0",
 *         "freeMonth": "1",
 *         "active": false
 *     }
 * ]
 */

/**
 * @api {post} /api/subscribes/object 2. Добавить подписку
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
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
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
 * "Не существует подписки с названием Extra Big"
 *
 * @apiSuccess (Success 200) Success Сообщение о создании подписки
 * @apiSuccessExample {json} Success 200:
 * "Подписка добавлена"
 */
