<?php

/**
 * @api {get} /api/user/auth 1. Получить авторизированного пользователя
 * @apiName GetUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) {Object} Success Авторизированный пользователь
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 2,
 *     "fio": "Максим Поздняков",
 *     "email": "maximpozdnyakow@gmail.com",
 *     "termsAgree": "1",
 *     "emailVerified": "0",
 *     "emailNotify": "1"
 * }
 */

/**
 * @api {post} /api/user/register 2. Регистрация
 * @apiName RegisterUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiDescription После успешной регистрации, на email пользователя отправляется код для подтверждения email.
 *
 * @apiParam {String} fio ФИО пользователя. Обязательный.
 * @apiParam {String} email Валидный email пользователя. Должен быть уникальным. Обязательный.
 * @apiParam {String} pass Пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.
 * @apiParam {Boolean} termsAgree Согласен ли пользователь с условиями соглашения. Должен быть true. Обязательный.
 *
 * @apiParamExample {json} Request:
 * {
 *    "email": "maximpozdnyakow@gmail.com",
 *    "fio": "Максим Поздняков",
 *    "termsAgree": true,
 *    "pass": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "fio": [
 *                "Укажите ФИО"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 200) Success Новый пользователь, токен авторизации
 * @apiSuccessExample {json} Success 200:
 * {
 *     "data": {
 *         "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
 *         "user": {
 *             "id": 2,
 *             "fio": "Максим Поздняков",
 *             "email": "maximpozdnyakow@gmail.com",
 *             "termsAgree": "1",
 *             "emailVerified": "0",
 *             "emailNotify": "1"
 *         }
 *     }
 * }
 *
 */

/**
 * @api {post} /api/user/login 3. Авторизация
 * @apiName LoginUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} email Email пользователя. Обязательный.
 * @apiParam {String} pass Пароль пользователя, соответствующий указанному email. Обязательный.

 * @apiParamExample {json} Request:
 * {
 *     "email": "maximpozdnyakow@gmail.com",
 *     "pass": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "email": [
 *                "Веденный вами электронный адрес не связан ни с одним аккаунтом"
 *            ],
 *            "pass": [
 *                "Вы ввели неверный пароль"
 *            ],
 *        }
 *     }
 *
 * @apiSuccess (Success 200) Success Пользователь, токен авторизации
 * @apiSuccessExample {json} Success 200:
 * {
 *     "data": {
 *         "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
 *         "user": {
 *             "id": 2,
 *             "fio": "Максим Поздняков",
 *             "email": "maximpozdnyakow@gmail.com",
 *             "termsAgree": "1",
 *             "emailVerified": "0",
 *             "emailNotify": "1"
 *         }
 *     }
 * }
 */

/**
 * @api {get} /api/user/logout 4. Выйти из аккаунта
 * @apiName LogoutUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiSuccess (Success 200) Success Сообщение о выходе
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Вы вышли из аккаунта"
 * }
 */

/**
 * @api {post} /api/user/restore 5. Запрос на отправку кода для сброса пароля
 * @apiName ForgotUserPassword
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} body Тело запроса, строка, валидный email существующего пользователя. Обязательный.
 * @apiParamExample {json} Request:
 * "maximpozdnyakow@gmail.com"
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 * {
 *     "message": "The given data was invalid.",
 *     "errors": [
 *         [
 *             "Укажите корректный email"
 *         ]
 *     ]
 * }
 *
 * @apiSuccess (Success 200) Success Сообщение об отправке шестизначного кода для сброса пароля
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Код для сброса пароля отправлен на вашу электронную почту"
 * }
 */

/**
 * @api {post} /api/user/reset 6. Сброс пароля
 * @apiName RestUserPassword
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} token Шестизначный код для сброса пароля. Обязательный.
 * @apiParam {String} pass Новый пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру. Обязательный.
 * @apiParamExample {json} Request:
 * {
 *     "token": "396402",
 *     "pass": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "token": [
 *                "Веденный вами код для сброса пароля недействителен"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 200) Success Сообщение о успешном изменении пароля
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Ваш пароль был успешно изменен"
 * }
 */

/**
 * @api {patch} /api/user/object 7. Обновление данных пользователя
 * @apiName UpdateUser
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiUse Authorization
 *
 * @apiParam {String} fio Новое ФИО пользователя.
 * @apiParam {String} email Новый валидный email пользователя. Должен быть уникальным. После обновления email, на него присылается код для подтверждения email.
 * @apiParam {String} pass Новый пароль пользователя, должен содержать от 8 символов, включая как минимум одну строчную букву, одну заглавную букву и одну цифру.
 *
 * @apiParamExample {json} Request:
 * {
 *     "fio": "Максим Поздняков Алексеевич",
 *     "email": "maxim@gmail.com",
 *     "pass": "SDGsdfn735F"
 * }
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 *     {
 *        "message": "The given data was invalid.",
 *        "errors": {
 *            "email": [
 *                "Пользователь с такими email уже существует"
 *            ]
 *        }
 *     }
 *
 * @apiSuccess (Success 200) Success Обновленный пользователь
 * @apiSuccessExample {json} Success 200:
 * {
 *     "id": 2,
 *     "fio": "Максим Поздняков Алексеевич",
 *     "email": "maxim@gmail.com",
 *     "termsAgree": "1",
 *     "emailVerified": 0,
 *     "emailNotify": "1"
 * }
 */

/**
 * @api {get} /api/user/check 8. Запросить новый код подтверждения email
 * @apiName SendVerifyCodeForUserEmail
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiSuccess (Success 200) Success Сообщение о успешном подтверждении email
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Код для подтверждения email отправлен на вашу электронную почту"
 * }
 */

/**
 * @api {post} /api/user/check 9. Подтверждение email
 * @apiName VerifyUserEmail
 * @apiGroup User
 * @apiVersion 1.0.0
 *
 * @apiParam {String} token Тело запроса, шестизначный код для подтверждения email.
 * @apiParamExample {json} Request:
 * "396402"
 *
 * @apiError (Bad request 404) BadRequest Некоторые параметры не прошли валидацию
 * @apiErrorExample {json} Bad request 404:
 *     {
 *        "message": "Веденный вами код для подтверждения email недействителен"
 *     }
 *
 * @apiSuccess (Success 200) Success Сообщение о успешном подтверждении email
 * @apiSuccessExample {json} Success 200:
 * {
 *     "message": "Ваша электронная почта была подтверждена"
 * }
 */
