<?php
/**
 * @api {post} /api/support Отправка сообщения в поддержку
 * @apiName Support
 * @apiGroup Support
 * @apiVersion 1.0.0
 * @apiUse Authorization
 *
 * @apiDescription https://ibb.co/MVwLswT - пример email, приходящего на почту компании
 *
 * @apiParam {String} theme Тема сообщения. Обязательный. Должен принимать одно из значений: "Ошибка в приложении", "Ошибка с оплатой", "Ошибка в синхронизации", "Предложения"
 * @apiParam {String} description Текст сообщения. Обязательный.
 * @apiParam {String} date Дата отправки сообщения в формате d.m.Y H:i. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "theme": "Предложения",
 *     "description": "Текст сообщения",
 *     "date": "07.09.2021 17:13"
 * }
 *
 * @apiError (Bad request 400) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 400:
 * {
 *    "message": "The given data was invalid.",
 *    "errors": {
 *        "theme": [
 *            "Параметр theme обязателен"
 *        ]
 *    }
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об отправке сообщения
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Спасибо, за обратную связь, мы ответим вам в ближайшее время"
 * }
 */
