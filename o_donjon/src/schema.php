<?php

namespace App;

use OpenApi\Annotations as OA;

/* ========== User schema ========== */

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

/* ========== Campaign schema ========== */

/**
 * @OA\Schema(
 *      schema="campaignList",
 *      description="List of campaign",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", nullable=true, property="description"),
 *      @OA\Property(type="string", nullable=true, property="memo"),
 *      @OA\Property(type="boolean", default=0, nullable=true, property="isArchived", example="false"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="invitationCode"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *          property="owner"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="campaign",
 *      description="Information of a campaign",
 *      allOf={@OA\Schema(ref="#/components/schemas/campaignList")},
 *      @OA\Property(type="integer", property="countCharacters"),
 *      @OA\Property(type="integer", property="countNpcs"),
 *      @OA\Property(type="integer", property="countStories"),
 *      @OA\Property(type="integer", property="countMaps"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="campaignStories",
 *      description="List of stories of the campaign",
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/story"), property="stories"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="campaignMaps",
 *      description="List of maps of the campaign",
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/map"), property="maps"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="campaignNPCs",
 *      description="List of NPCs of the campaign",
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/npc"), property="NPCs"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="campaignCharacters",
 *      description="List of Characters of the campaign",
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/character"), property="characters"),
 * )
 */

/**
 * @OA\RequestBody(
 *      request="campaign",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"name", "password", "name", "avatarPath"},
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *          @OA\Property(type="string", nullable=true, property="description"),
 *          @OA\Property(type="string", nullable=true, property="memo"),
 *          @OA\Property(type="boolean", default=0, nullable=true, property="isArchived", example="false"),
 *      )
 * )
 */

/* ========== Story schema ========== */

/**
 * @OA\Schema(
 *      schema="story",
 *      description="Information of a story",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", nullable=true, property="description"),
 *      @OA\Property(type="boolean", default=0, nullable=true, example="false", property="isDone"),
 *      @OA\Property(type="string", nullable=true, property="report"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="storyInfo",
 *      description="Information of a story",
 *      allOf={@OA\Schema(ref="#/components/schemas/story")},
 *      @OA\Property(type="integer", nullable=true, property="campaign"),
 * )
 */

/* ========== Map schema ========== */

/**
 * @OA\Schema(
 *      schema="map",
 *      description="Information of a map",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="filePath"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="mapInfo",
 *      description="Information of a map",
 *      allOf={@OA\Schema(ref="#/components/schemas/map")},
 *      @OA\Property(type="integer", nullable=true, property="campaign"),
 * )
 */

/* ========== Npc schema ========== */

/**
 * @OA\Schema(
 *      schema="npc",
 *      description="Information of a NPC",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="type"),
 *      @OA\Property(type="string", nullable=true, property="description"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="isAlly"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="npcInfo",
 *      description="Information of a NPC",
 *      allOf={@OA\Schema(ref="#/components/schemas/npc")},
 *      @OA\Property(type="integer", nullable=true, property="campaign"),
 * )
 */

/* ========== Character schema ========== */

/**
 * @OA\Schema(
 *      schema="character",
 *      description="Information of a character",
 *      @OA\Property(type="integer", property="id"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name"),
 *      @OA\Property(type="string", maxLength=255, nullable=true, property="avatar_path"),
 *      @OA\Property(type="integer", default=0, property="age"),
 *      @OA\Property(type="integer", default=0, property="initiative"),
 *      @OA\Property(type="integer", default=0, property="height"),
 *      @OA\Property(type="integer", default=0, property="weight"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="eyes"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="skin"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="hair"),
 *      @OA\Property(type="string", nullable=true, property="appearance"),
 *      @OA\Property(type="string", nullable=true, property="personality_traits"),
 *      @OA\Property(type="string", nullable=true, property="ideals"),
 *      @OA\Property(type="string", nullable=true, property="bonds"),
 *      @OA\Property(type="string", nullable=true, property="flaws"),
 *      @OA\Property(type="string", nullable=true, property="allies_and_organizations"),
 *      @OA\Property(type="string", nullable=true, property="backstory"),
 *      @OA\Property(type="string", nullable=true, property="treasure"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="background"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="alignement"),
 *      @OA\Property(type="string", nullable=true, property="attacks_and_spellcasting"),
 *      @OA\Property(type="string", nullable=true, property="equipment"),
 *      @OA\Property(type="string", nullable=true, property="other_proficiencies_and_languages"),
 *      @OA\Property(type="string", nullable=true, property="features_and_traits"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="characterInfo",
 *      description="Information of a character",
 *      allOf={@OA\Schema(ref="#/components/schemas/npc")},
 *      @OA\Property(type="integer", nullable=true, property="campaign"),
 * )
 */