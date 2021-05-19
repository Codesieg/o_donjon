<?php

namespace App;

use OpenApi\Annotations as OA;

/* User schema */

/**
 * @OA\Schema(
 *      schema="userList",
 *      description="List of the users",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="user",
 *      description="user informations",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=180, uniqueItems=true, property="email"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath"),
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/userCampaignList"), property="campaigns"),
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/characterList"), property="characters"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="userCampaignList",
 *      description="List of the campaigns",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 * )
 */

 /**
 * @OA\Schema(
 *      schema="characterList",
 *      description="List of the characters",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 * )
 */

/**
 * @OA\RequestBody(
 *      request="registerUser",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"email", "password", "name", "avatarPath"},
 *          @OA\Property(type="string", maxLength=180, uniqueItems=true, property="email"),
 *          @OA\Property(type="string", property="password"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *          @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath"),
 *      )
 * )
 */

/**
 * @OA\RequestBody(
 *      request="joinCampaignUser",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"invitationCode"},
 *          @OA\Property(type="string", maxLength=64, property="invitationCode"),
 *      )
 * )
 */

/* Campaign schema */

/**
 * @OA\Schema(
 *      schema="campaignList",
 *      description="List of campaign",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="text", nullable=true, property="description"),
 *      @OA\Property(type="text", nullable=true, property="memo"),
 *      @OA\Property(type="boolean", default=0 , nullable=true, property="isArchived"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="invitationCode"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *          property="owner"),
 * )
 */
