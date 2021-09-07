<?php
/**
 * @apiDefine Authorization
 *
 * @apiPermission Авторизованный пользователь |
 *
 * @apiHeader {String} Authorization Bearer $token
 * @apiHeaderExample {json} Header:
 *     { "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO" }
 *
 * @apiError (Unauthenticated 401) Unauthenticated Не был предоставлен токен авторизации, или же он недействителен
 * @apiErrorExample {json} Unauthenticated 401:
 *     {
 *       "message": "Unauthenticated."
 *     }
 */

/**
 * @apiDefine WithChild
 *
 * @apiPermission Пользователь, являющийся родителем указанного ребенка |
 *
 * @apiError (Not your child 403) NotYourChild Указанный ребенок не существует или не принадлежит текущему пользователю
 * @apiErrorExample {json} Not your child 403:
 *     {
 *       "message": "Указанный ребенок вам не принадлежит"
 *     }
 */

/**
 * @apiDefine WithSubscription
 *
 * @apiPermission Пользователь, обладающий активной подпиской
 *
 * @apiError (No subscription 403) NoSubscription Пользователь не оформил подписку
 * @apiErrorExample {json} No subscription 403:
 *     {
 *       "message": "Оформите подписку"
 *     }
 *
 * @apiError (Subscription expired 403) SubscriptionExpired Подписка пользователя истекла
 * @apiErrorExample {json} Subscription expired 403:
 *     {
 *       "message": "Действие вашей подписки истекло, оформите новую"
 *     }
 */
