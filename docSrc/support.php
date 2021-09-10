<?php
/**
 * @api {get} /api/support/themes Получить все темы
 * @apiName GetSupportThemes
 * @apiGroup Support
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) Success Массив тем
 * @apiSuccessExample {json} Success 200:
 * [
 *     "Ошибка в приложении",
 *     "Ошибка с оплатой",
 *     "Ошибка в синхронизации",
 *     "Предложения"
 * ]
 */

/**
 * @api {post} /api/support/object Отправка сообщения в поддержку
 * @apiName Support
 * @apiGroup Support
 * @apiVersion 1.0.0
 * @apiUse Authorization
 *
 * @apiDescription https://ibb.co/MVwLswT - пример email, приходящего на почту компании
 *
 * @apiParam {String} theme Тема сообщения. Обязательный. Должен принимать одно из значений: "Ошибка в приложении", "Ошибка с оплатой", "Ошибка в синхронизации", "Предложения"
 * @apiParam {String} message Текст сообщения. Обязательный.
 * @apiParam {String} date Дата отправки сообщения в формате d.m.Y H:i. Обязательный.
 * @apiParam {String} fio ФИО пользователя, отправившего сообщение. Обязательный.
 * @apiParam {String} email Email пользователя, отправившего сообщение. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *     "fio": "Поздняков Максим Алексеевич",
 *     "email": "maximpozdnyakow@gmail.com",
 *     "theme": "Ошибка с оплатой",
 *     "message": "Обращение в службу поддержки"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
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
