<?php

namespace App;

use OpenApi\Annotations as OA;

/* ========== User schema ========== */

/**
 * @OA\Schema(
 *      schema="userList",
 *      description="List of the users",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Martin"),
 *      @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath", example="avatar_martin.png"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="user",
 *      description="user informations",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=180, uniqueItems=true, property="email", example="martin@odonjon.com"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Martin"),
 *      @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath", example="avatar_martin.png"),
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/userCampaignList"), property="campaigns"),
 *      @OA\Property(type="array", @OA\Items(ref="#/components/schemas/characterList"), property="characters"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="userCampaignList",
 *      description="List of the campaigns",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="characterList",
 *      description="List of the characters",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Dwalïn"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="connectionUser",
 *      description="JWT and user data",
 *      @OA\Property(type="string", property="token", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MjE0OTgwODYsImV4cCI6MTYyMTUyNjg4Niwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoibmFlbEBvZG9uam9uLmNvbSJ9.tR9dFk5g2tJ1YnV_vGBFmP-37LnaOAqhvgT6VhunNVnmd5xIriR50_hmqa5PMkFFHwSurx2KoxwhpZEOXKabSdRb2yipHszo64TIDNjV35jdli8JAOxX6xSQBqE1lK6-iOKJay7Eeuu1N7TViJdbPfDZodomLDLXOdd3ZHMOb8m3-YerQ0mhHNPf5ze2pYbUgoRG8iOGZJtUnQRYutSqeIEQFqk696gyWJKnG_yd16aPhvzf12gmn4cctOhbpO9-oxt6GDAuMpcEBZVoYhkbNN53QJJ6aCZfp2TpUkbL8io8jPdrUxcil_-yMFVnjBewkzTjFdmypWh2Qo4Dad2K7w"),  
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", property="email", example="example@odonjon.com"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Martin"),
 *          @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath", example="avatar_martin.png"),
 *          property="data"),
 * )
 */

/**
 * @OA\RequestBody(
 *      request="connectionUser",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"username", "password"},
 *          @OA\Property(type="string", property="username", example="martin@odonjon.com"),
 *          @OA\Property(type="string", property="password", example="password"),
 *      )
 * )
 */

/**
 * @OA\RequestBody(
 *      request="registerUser",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"email", "name", "avatarPath"},
 *          @OA\Property(type="string", maxLength=180, uniqueItems=true, property="email", example="martin@odonjon.com"),
 *          @OA\Property(type="string", property="password", example="password"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Martin"),
 *          @OA\Property(type="string", maxLength=255, nullable=true, property="avatarPath", example="avatar_martin.png"),
 *      )
 * )
 */

/**
 * @OA\RequestBody(
 *      request="joinCampaignUser",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"invitationCode"},
 *          @OA\Property(type="string", maxLength=64, property="invitationCode", example="60a60a7d4e18a"),
 *      )
 * )
 */

/* ========== Campaign schema ========== */

/**
 * @OA\Schema(
 *      schema="campaignList",
 *      description="List of campaign",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 *      @OA\Property(type="string", nullable=true, property="description", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="memo", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="boolean", default=0, nullable=true, property="isArchived", example="false"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="invitationCode", example="60a60a7d4e18a"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Martin"),
 *          property="owner"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="campaign",
 *      description="Information of a campaign",
 *      allOf={@OA\Schema(ref="#/components/schemas/campaignList")},
 *      @OA\Property(type="integer", property="countCharacters", example="5"),
 *      @OA\Property(type="integer", property="countNpcs", example="17"),
 *      @OA\Property(type="integer", property="countStories", example="3"),
 *      @OA\Property(type="integer", property="countMaps", example="11"),
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
 *          required={"name", "description", "memo", "isArchived"},
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 *          @OA\Property(type="string", nullable=true, property="description", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="memo", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="boolean", default=0, nullable=true, property="isArchived", example="false"),
 *      )
 * )
 */

/* ========== Story schema ========== */

/**
 * @OA\Schema(
 *      schema="story",
 *      description="Information of a story",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="disparition mystérieuse au poulailler"),
 *      @OA\Property(type="string", nullable=true, property="description", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="boolean", default=0, nullable=true, property="isDone", example="false"),
 *      @OA\Property(type="string", nullable=true, property="report", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 *      @OA\Property(type="integer", property="campaign", example="7"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="storyInfo",
 *      description="Information of a story",
 *      allOf={@OA\Schema(ref="#/components/schemas/story")},
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 *          property="campaign"),
 *      )
 * )
 */

/**
 * @OA\RequestBody(
 *      request="story",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"name", "description", "isDone", "report", "campaign"},
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="disparition mystérieuse au poulailler"),
 *          @OA\Property(type="string", nullable=true, property="description", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="boolean", default=0, nullable=true, property="isDone", example="false"),
 *          @OA\Property(type="string", nullable=true, property="report", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="integer", property="campaign"),
 *      )
 * )
 */

/* ========== Map schema ========== */

/**
 * @OA\Schema(
 *      schema="map",
 *      description="Information of a map",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="filePath", example="poulailler.png"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Le poulailler de ma grand-mère"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 *          property="campaign"),
 *      ),
 * )
 */

/**
 * @OA\Schema(
 *      schema="mapInfo",
 *      description="Information of a map",
 *      allOf={@OA\Schema(ref="#/components/schemas/map")},
 *      @OA\Property(type="string", nullable=true, property="description", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 * )
 */

/**
 * @OA\RequestBody(
 *      request="map",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"filePath", "name", "description", "campaign"},
 *          @OA\Property(type="string", maxLength=255, nullable=true, property="filePath", example="poulailler.png"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Le poulailler de ma grand-mère"),
 *          @OA\Property(type="string", nullable=true, property="description", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="integer", property="campaign", example="7"),
 *      )
 * )
 */

/* ========== Npc schema ========== */

/**
 * @OA\Schema(
 *      schema="npc",
 *      description="Information of a NPC",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Cocotte"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="type", example="animal"),
 *      @OA\Property(type="string", nullable=true, property="description", example="Au mon dieu une poule qui parle !"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="isAlly", example="true"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="npcInfo",
 *      description="Information of a NPC",
 *      allOf={@OA\Schema(ref="#/components/schemas/npc")},
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 *          property="campaign"),
 *      ),
 * )
 */

/**
 * @OA\RequestBody(
 *      request="npc",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"name", "type", "description", "isAlly", "campaign"},
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Cocotte"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="type", example="animal"),
 *          @OA\Property(type="string", nullable=true, property="description", example="Au mon dieu une poule qui parle !"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="isAlly", example="true"),
 *          @OA\Property(type="integer", property="campaign", example="7"),
 *      )
 * )
 */

/* ========== Character schema ========== */

/**
 * @OA\Schema(
 *      schema="character",
 *      description="Information of a character",
 *      @OA\Property(type="integer", property="id", example="7"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Dwalïn"),
 *      @OA\Property(type="string", maxLength=255, nullable=true, property="avatar_path", example="dwalin.png"),
 *      @OA\Property(type="integer", default=0, property="age", example="97"),
 *      @OA\Property(type="integer", default=0, property="initiative", example="2"),
 *      @OA\Property(type="integer", default=0, property="height", example="137"),
 *      @OA\Property(type="integer", default=0, property="weight", example="61"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="eyes", example="marron"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="skin", example="blanche"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="hair", example="roux"),
 *      @OA\Property(type="string", nullable=true, property="appearance", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="personality_traits", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="ideals", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="bonds", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="flaws", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="allies_and_organizations", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="backstory", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="treasure", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="background", example="forgeron"),
 *      @OA\Property(type="string", maxLength=64, nullable=true, property="alignement", example="Loyal neutre"),
 *      @OA\Property(type="string", nullable=true, property="attacks_and_spellcasting", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="equipment", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="other_proficiencies_and_languages", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", nullable=true, property="features_and_traits", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *      @OA\Property(type="string", format="date-time", property="createdAt"),
 *      @OA\Property(type="string", format="date-time", nullable=true, property="updatedAt"),
 * )
 */

/**
 * @OA\Schema(
 *      schema="characterInfo",
 *      description="Information of a character",
 *      allOf={@OA\Schema(ref="#/components/schemas/character")},
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Martin"),
 *          property="user"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", property="id", example="7"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Les poules de ma grand-mère"),
 *          property="campaign"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="nain"),
 *          @OA\Property(type="string", nullable=true, property="informations", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          property="race"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="guerrier"),
 *          @OA\Property(type="string", nullable=true, property="informations", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          property="class"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", default=0, property="level", example="13"),
 *          @OA\Property(type="integer", default=0, property="experience", example="6911"),
 *          @OA\Property(type="boolean", default=false, example="false", property="inspiration"),
 *          @OA\Property(type="integer", default=0, property="armorClass", example="13"),
 *          @OA\Property(type="integer", default=0, property="speed", example="7"),
 *          @OA\Property(type="integer", default=0, property="currentHP", example="47"),
 *          @OA\Property(type="integer", default=0, property="totalHP", example="53"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="hitDice", example="1D8"),
 *          @OA\Property(type="integer", default=0, property="deathSavesSuccess", example="0"),
 *          @OA\Property(type="integer", default=0, property="deathSavesFailures", example="0"),
 *          property="caracteristics"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="integer", default=0, property="strength", example="17"),
 *          @OA\Property(type="integer", default=0, property="dexterity", example="11"),
 *          @OA\Property(type="integer", default=0, property="constitution", example="13"),
 *          @OA\Property(type="integer", default=0, property="intelligence", example="7"),
 *          @OA\Property(type="integer", default=0, property="wisdom", example="11"),
 *          @OA\Property(type="integer", default=0, property="charisma", example="13"),
 *          @OA\Property(type="integer", default=0, property="passiveWisdom", example="2"),
 *          @OA\Property(type="integer", default=0, property="proficiencyBonus", example="2"),
 *          property="statistics"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="spellcasting_class", example="invocateur"),
 *          @OA\Property(type="integer", default=0, property="spell_attack_bonus", example="2"),
 *          @OA\Property(type="integer", default=0, property="spellcasting_ability", example="2"),
 *          @OA\Property(type="integer", default=0, property="spell_save_dc", example="2"),
 *          @OA\Property(type="string", nullable=true, property="spells_list", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          property="spell"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="boolean", default=false, example="true", property="strength"),
 *          @OA\Property(type="boolean", default=false, example="false", property="dexterity"),
 *          @OA\Property(type="boolean", default=false, example="true", property="constitution"),
 *          @OA\Property(type="boolean", default=false, example="false", property="intelligence"),
 *          @OA\Property(type="boolean", default=false, example="false", property="wisdom"),
 *          @OA\Property(type="boolean", default=false, example="false", property="charisma"),
 *          property="savingThrowspell"),
 *      @OA\Property(
 *          type="object",
 *          @OA\Property(type="boolean", default=false, example="false", property="acrobatics"),
 *          @OA\Property(type="boolean", default=false, example="true", property="animalHandling"),
 *          @OA\Property(type="boolean", default=false, example="false", property="arcana"),
 *          @OA\Property(type="boolean", default=false, example="false", property="athletics"),
 *          @OA\Property(type="boolean", default=false, example="false", property="deception"),
 *          @OA\Property(type="boolean", default=false, example="false", property="history"),
 *          @OA\Property(type="boolean", default=false, example="false", property="insight"),
 *          @OA\Property(type="boolean", default=false, example="true", property="intimidation"),
 *          @OA\Property(type="boolean", default=false, example="false", property="investigation"),
 *          @OA\Property(type="boolean", default=false, example="false", property="medecine"),
 *          @OA\Property(type="boolean", default=false, example="false", property="nature"),
 *          @OA\Property(type="boolean", default=false, example="false", property="perception"),
 *          @OA\Property(type="boolean", default=false, example="false", property="performance"),
 *          @OA\Property(type="boolean", default=false, example="false", property="persuasion"),
 *          @OA\Property(type="boolean", default=false, example="true", property="religion"),
 *          @OA\Property(type="boolean", default=false, example="false", property="sleightOfHand"),
 *          @OA\Property(type="boolean", default=false, example="false", property="stealth"),
 *          @OA\Property(type="boolean", default=false, example="true", property="survival"),
 *          property="skill"),
 *      @OA\Property(type="boolean", default=false, example="false", property="isDead"),
 * )
 */


/**
 * @OA\RequestBody(
 *      request="characterName",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"name"},
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Dwalïn"),
 *      )
 * )
 */

/**
 * @OA\RequestBody(
 *      request="character",
 *      required=true,
 *      @OA\JsonContent(
 *          required={"name", "avatar_path", "age", "initiative", "height", "weight", "eyes", "skin", "hair", "appearance", "personality_traits", "ideals", "bonds","flaws", "allies_and_organizations", "backstory", "treasure", "background", "alignement", "attacks_and_spellcasting", "equipment", "other_proficiencies_and_languages", "features_and_traits", "campaign", "race", "class", "caracteristics", "statistics", "spell", "savingThrowspell", "skill", "isDead"},
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="Dwalïn"),
 *          @OA\Property(type="string", maxLength=255, nullable=true, property="avatar_path", example="dwalin.png"),
 *          @OA\Property(type="integer", default=0, property="age", example="97"),
 *          @OA\Property(type="integer", default=0, property="initiative", example="2"),
 *          @OA\Property(type="integer", default=0, property="height", example="137"),
 *          @OA\Property(type="integer", default=0, property="weight", example="61"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="eyes", example="marron"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="skin", example="blanche"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="hair", example="roux"),
 *          @OA\Property(type="string", nullable=true, property="appearance", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="personality_traits", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="ideals", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="bonds", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="flaws", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="allies_and_organizations", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="backstory", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="treasure", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="background", example="forgeron"),
 *          @OA\Property(type="string", maxLength=64, nullable=true, property="alignement", example="Loyal neutre"),
 *          @OA\Property(type="string", nullable=true, property="attacks_and_spellcasting", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="equipment", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="other_proficiencies_and_languages", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="string", nullable=true, property="features_and_traits", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *          @OA\Property(type="integer", property="campaign"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="nain"),
 *              @OA\Property(type="string", nullable=true, property="informations", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *              property="race"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="string", maxLength=64, nullable=true, property="name", example="guerrier"),
 *              @OA\Property(type="string", nullable=true, property="informations", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *              property="class"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="integer", default=0, property="level", example="13"),
 *              @OA\Property(type="integer", default=0, property="experience", example="6911"),
 *              @OA\Property(type="boolean", default=false, example="false", property="inspiration", property="inspiration"),
 *              @OA\Property(type="integer", default=0, property="armorClass", example="13"),
 *              @OA\Property(type="integer", default=0, property="speed", example="7"),
 *              @OA\Property(type="integer", default=0, property="currentHP", example="47"),
 *              @OA\Property(type="integer", default=0, property="totalHP", example="53"),
 *              @OA\Property(type="string", maxLength=64, nullable=true, property="hitDice", example="1D8"),
 *              @OA\Property(type="integer", default=0, property="deathSavesSuccess", example="0"),
 *              @OA\Property(type="integer", default=0, property="deathSavesFailures", example="0"),
 *              property="caracteristics"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="integer", default=0, property="strength", example="17"),
 *              @OA\Property(type="integer", default=0, property="dexterity", example="11"),
 *              @OA\Property(type="integer", default=0, property="constitution", example="13"),
 *              @OA\Property(type="integer", default=0, property="intelligence", example="7"),
 *              @OA\Property(type="integer", default=0, property="wisdom", example="11"),
 *              @OA\Property(type="integer", default=0, property="charisma", example="13"),
 *              @OA\Property(type="integer", default=0, property="passiveWisdom", example="2"),
 *              @OA\Property(type="integer", default=0, property="proficiencyBonus", example="2"),
 *              property="statistics"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="string", maxLength=64, nullable=true, property="spellcasting_class", example="invocateur"),
 *              @OA\Property(type="integer", default=0, property="spell_attack_bonus", example="2"),
 *              @OA\Property(type="integer", default=0, property="spellcasting_ability", example="2"),
 *              @OA\Property(type="integer", default=0, property="spell_save_dc", example="2"),
 *              @OA\Property(type="string", nullable=true, property="spells_list", example="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Possimus impedit sequi amet ipsa, recusandae cumque, culpa ullam officia optio qui reiciendis similique, illo illum minus quaerat vitae aliquid iure labore!"),
 *              property="spell"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="boolean", default=false, example="true", property="strength"),
 *              @OA\Property(type="boolean", default=false, example="false", property="dexterity"),
 *              @OA\Property(type="boolean", default=false, example="true", property="constitution"),
 *              @OA\Property(type="boolean", default=false, example="false", property="intelligence"),
 *              @OA\Property(type="boolean", default=false, example="false", property="wisdom"),
 *              @OA\Property(type="boolean", default=false, example="false", property="charisma"),
 *              property="savingThrowspell"),
 *          @OA\Property(
 *              type="object",
 *              @OA\Property(type="boolean", default=false, example="false", property="acrobatics"),
 *              @OA\Property(type="boolean", default=false, example="true", property="animalHandling"),
 *              @OA\Property(type="boolean", default=false, example="false", property="arcana"),
 *              @OA\Property(type="boolean", default=false, example="false", property="athletics"),
 *              @OA\Property(type="boolean", default=false, example="false", property="deception"),
 *              @OA\Property(type="boolean", default=false, example="false", property="history"),
 *              @OA\Property(type="boolean", default=false, example="false", property="insight"),
 *              @OA\Property(type="boolean", default=false, example="true", property="intimidation"),
 *              @OA\Property(type="boolean", default=false, example="false", property="investigation"),
 *              @OA\Property(type="boolean", default=false, example="false", property="medecine"),
 *              @OA\Property(type="boolean", default=false, example="false", property="nature"),
 *              @OA\Property(type="boolean", default=false, example="false", property="perception"),
 *              @OA\Property(type="boolean", default=false, example="false", property="performance"),
 *              @OA\Property(type="boolean", default=false, example="false", property="persuasion"),
 *              @OA\Property(type="boolean", default=false, example="true", property="religion"),
 *              @OA\Property(type="boolean", default=false, example="false", property="sleightOfHand"),
 *              @OA\Property(type="boolean", default=false, example="false", property="stealth"),
 *              @OA\Property(type="boolean", default=false, example="true", property="survival"),
 *              property="skill"),
 *          @OA\Property(type="boolean", default=false, example="false", property="isDead"),
 *      )
 * )
 */