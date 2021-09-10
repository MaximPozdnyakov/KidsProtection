<?php
/**
 * @apiDefine Authorization
 *
 * @apiPermission Авторизованный пользователь |
 *
 * @apiHeader {String} Authorization Bearer $token
 * @apiHeaderExample {json} Authorization Header:
 *     { "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9eyJhdWQiO" }
 *
 * @apiError (Unauthenticated 404) Unauthenticated Не был предоставлен токен авторизации, или же он недействителен
 * @apiErrorExample {json} Unauthenticated 404:
 *     {
 *       "message": "Unauthenticated."
 *     }
 */

/**
 * @apiDefine WithChild
 *
 * @apiPermission Пользователь, являющийся родителем указанного ребенка |
 *
 * @apiError (Not your child 404) NotYourChild Указанный ребенок не существует или не принадлежит текущему пользователю
 * @apiErrorExample {json} Not your child 404:
 *     {
 *       "message": "Указанный ребенок вам не принадлежит"
 *     }
 */

/**
 * @apiDefine WithSubscription
 *
 * @apiPermission Пользователь, обладающий активной подпиской
 *
 * @apiError (No subscription 404) NoSubscription Пользователь не оформил подписку
 * @apiErrorExample {json} No subscription 404:
 *     {
 *       "message": "Оформите подписку"
 *     }
 *
 * @apiError (Subscription expired 404) SubscriptionExpired Подписка пользователя истекла
 * @apiErrorExample {json} Subscription expired 404:
 *     {
 *       "message": "Действие вашей подписки истекло, оформите новую"
 *     }
 */
