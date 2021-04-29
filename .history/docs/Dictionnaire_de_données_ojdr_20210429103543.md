# Dictionnaire de données

## Personnage (`character `)

| Champ                             | Type          | Spécificités                                    | Description                                      |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de notre personnage                |
| name                              | VARCHAR(64)   | NULL                                            | Le nom du personnage                             |
| avatar                            | VARCHAR(64)   | NULL                                            | L'avatar du personnage                           |
| age                               | INT           | NULL                                            | L'age du personnage                              |
| height                            | INT           | NULL                                            | La taille du personange                          |
| weight                            | INT           | NULL                                            | Le poids du personange                           |
| eyes                              | VARCHAR(64)   | NULL                                            | La couleur des yeux du personnage                |
| skin                              | VARCHAR(64)   | NULL                                            | La couleur de peau du personnage                 |
| hair                              | VARCHAR(64)   | NULL                                            | La couleur et le type de cheveu du personnage    |
| appearance                        | LONGTEXT      | NULL                                            | Description physique du personnage               |
| personality_traits                | LONGTEXT      | NULL                                            | Traits de personnalités du personnage            |
| ideals                            | LONGTEXT      | NULL                                            | L'objectif ultime du personnage                  |
| bonds                             | VARCHAR(64)   | NULL                                            | Relations proche du personnage                   |
| flaws                             | VARCHAR(64)   | NULL                                            | Défauts du personnage                            |
| allies_and_organizations          | LONGTEXT      | NULL                                            | Alliés, organisations, guildes du personnage     |
| backstory                         | LONGTEXT      | NULL                                            | L'histoire du personnage                         |
| treasure                          | LONGTEXT      | NULL                                            | Objets précieux du personnage                    |
| background                        | VARCHAR(64)   | NULL                                            | Passif du personnage (forgeron, voleur ...)      |
| alignement                        | VARCHAR(64)   | NULL                                            | Aligement du personnage                          |
| equipment                         | LONGTEXT      | NULL                                            | Inventaires du personnage                        |
| other_proficiencies_and_languages | LONGTEXT      | NULL                                            | Compétences et langages du personnage            |
| features_and_traits               | LONGTEXT      | NULL                                            | Caractéristiques et particularitées              |
| class_id                          | ENTITY        | NULL                                            | La class du personnage                           |
| stats_id                          | ENTITY        | NULL                                            | Le status du personnage                          |
| saving_throws_id                  | ENTITY        | NULL                                            | Le dés de sauvegarde du personnage               |
| skill_id                          | ENTITY        | NULL                                            | Les compétences du personnage                    |
| race_id                           | ENTITY        | NULL                                            | La race du personnage                            |
| created_at                        | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création du personnage                |
| updated_at                        | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour du personnage |

## Statistiques (`character_stats`)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| level                             | INT           | NOT NULL, DEFAULT 1                             | Le niveau de notre personnage                 |
| experience                        | INT           | NOT NULL, DEFAULT 0                             | L'expérience du personnage                    |
| inspiration                       | BOOL          | NOT NULL, DEFAULT FALSE                         | Action remarquable                            |
| armor_class                       | INT           | NOT NULL, DEFAULT 0                             | Classe d'armure                               |
| speed                             | INT           | NOT NULL, DEFAULT 0                             | Vitesse de déplacement du personnage          |
| current_hp                        | INT           | NOT NULL, DEFAULT 0                             | Point de vie actuel du personnage             |
| total_hp                          | INT           | NOT NULL, DEFAULT 0                             | Point de vie total du personnage              |
| hit_dice                          | VARCHAR(64)   | NULL                                            | Nombre de dés de vie du personnage            |
| death_saves_success               | INT           | NOT NULL, DEFAULT 0                             | Succés jets sauvegarde de mort                |
| death_saves_failures              | INT           | NOT NULL, DEFAULT 0                             | Échecs jets sauvegarde de mort                |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspondant       |



## Sort (`character_spell`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| spellcasting_class                | VARCHAR(64)   | NULL                                            | Nom de classe du lançeur de sort (invocateur, élémentaliste)             |
| spell_attack_bonus                | INT           | NOT NULL, DEFAULT 0                             | Bonus d'attaque d'un sort                                                |
| spellcasting_ability              | INT           | NOT NULL, DEFAULT 0                             | Caractéristique principale liée au sort                                  |
| spell_save_dc                     | INT           | NOT NULL, DEFAULT 0                             | Résistance à la magie                                                    |
| spells_list                       | LONGTEXT      | NOT NULL                                        | Liste des sorts du personnage                                            |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspondant       |


## Jets de sauvegarde  (`character_saving_throw `)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| strength                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de force                    |
| dexterity                         | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de dexterité                |
| constitution                      | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de constitution             |
| intelligence                      | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de intelligence             |
| wisdom                            | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de sagesse                  |
| charisma                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de charisme                 |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspondant       |


## Compétence  (`character_skill `)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| acrobatics                        | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence acrobatiques                       |
| animal_handling                   | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de dressage                        |
| arcana                            | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence arcanes                            |
| athletics                         | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence athlétiques                        |
| deception                         | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de tromperie                       |
| history                           | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence historique                         |
| insight                           | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de perspicacité                    |
| intimidation                      | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence d'intimidation                     |
| investigation                     | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence d'investigation                    |
| medecine                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de soin                            |
| nature                            | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence nature                             |
| perception                        | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de perception                      |
| performance                       | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence performance                        |
| persuasion                        | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de persuasion                      |
| religion                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence religion                           |
| sleight_of_hand                   | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de tour de passe passe             |
| stealth                           | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de furtivité                       |
| survival                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Compétence de survie                          |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspondant       |


## Race  (`character_race`)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| nom                               | VARCHAR(64)   | NOT NULL                                        | Nom de la race                                |
| informations                      | LONGTEXT      | NOT NULL                                        | Déscriptif de la race                         |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspodant        |

## Classe  (`character_class`)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| nom                               | VARCHAR(64)   | NOT NULL                                        | Nom de la class                               |
| informations                      | LONGTEXT      | NOT NULL                                        | Déscriptif de la class                        |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspondant       |  

## Modifier (`character_modifier`)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| strength                          | INT           | NOT NULL, DEFAULT 0                             | Le niveau de notre personnage                 |
| dexterity                         | INT           | NOT NULL, DEFAULT 0                             | L'expérience du personnage                    |
| constitution                      | INT           | NOT NULL, DEFAULT 0                             | Action remarquable                            |
| intelligence                      | INT           | NOT NULL, DEFAULT 0                             | Bonus de compétences                          |
| wisdom                            | INT           | NOT NULL, DEFAULT 0                             | Classe d'armure                               |
| charisma                          | INT           | NOT NULL, DEFAULT 0                             | Bonus determinant l'ordre d'action            |
| passive_wisdom                    | INT           | NOT NULL, DEFAULT 0                             | Maitrise de soi                               | 
| proficiency_bonus                 | INT           | NOT NULL, DEFAULT 0                             | Bonus de maitrise                             |
| character_id                      | ENTITY        | NOT NULL                                        | Identifiant du personnage correspondant       |



## Campagne (`campaign`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | INT           | NOT NULL                                        | Nom de la campagne                                                       |
| description                       | LONGTEXT      | NOT NULL                                        | Histoire de la campagne                                                  |
| created_at                        | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de la campagne                                       |
| updated_at                        | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de la campagne                        |

## Carte (`map`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | VARCHAR(64)   | NOT NULL                                        | Nom de la carte                                                          |
| description                       | LONGTEXT      | NOT NULL                                        | Description de la carte                                                  |
| campaign_id                       | ENTITY        | NOT NULL                                        | Identifiant de la campagne correspondante                                |
| created_at                        | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de la carte                                          |
| updated_at                        | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de la carte                           |

## Utilisateur (`user`)

| Champ                              | Type                                     | Spécificités                                    | Description                                                    |
| ---------------------------------- | ---------------------------------------- | ----------------------------------------------- | -------------------------------------------------------------- |
| id                                 | INT                                      | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de notre utilisateur                             |
| email                              | VARCHAR(64)                              | NOT NULL, UNIQUE                                | L'email de l'utilisateur                                       |
| password                           | VARCHAR(64)                              | NOT NULL                                        | Le mot de passe de l'utilisateur                               |
| pseudo                             | VARCHAR(64)                              | NOT NULL                                        | Le pseudo de l'utilisateur                                     |
| avatar                             | VARCHAR(64)                              | NULL                                            | La photo d'avatar de l'utilisateur                             |
| role                               | ENUM('admin', 'DM', 'Player',)           | NOT NULL, DEFAULT 'reader'                      | Le rôle de l'utilisateur                                       |
| status                             | TINYINT(3)                               | NOT NULL, DEFAULT 0                             | Le statut de l'utilisateur (1=actif, 2=désactivé/bloqué)       |
| created_at                         | TIMESTAMP                                | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création du compte utilisateur                      |
| updated_at                         | TIMESTAMP                                | NULL                                            | La date de la dernière mise à jour de l'utilisateur            |

## Monstre (`monster`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | VARCHAR(64)   | NOT NULL                                        | Nom du monstre                                                           |
| type                              | VARCHAR(64)   | NULL                                            | Nom du monstre                                                           |
| description                       | LONGTEXT      | NULL                                            | Description du monstre                                                   |
| campaign_id                       | ENTITY        | NOT NULL                                        | Identifiant de la campagne correspondante                                |
| story_id                          | ENTITY        | NULL                                        | Identifiant de l'histoire correspondante                                 |

## NPC (`npc`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | VARCHAR(64)   | NOT NULL                                        | Nom du NPC                                                               |
| description                       | LONGTEXT      | NOT NULL                                        | Description du NPC                                                       |
| campaign_id                       | ENTITY        | NOT NULL                                        | Identifiant de la campagne correspondante                                |
| story_id                          | ENTITY        | NULL                                        | Identifiant de l'histoire correspondante                                 |

## Histoire (`story`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | VARCHAR(64)   | NOT NULL                                        | Nom de l'histoire                                                        |
| description                       | LONGTEXT      | NOT NULL                                        | Description de l'histoire                                                |
| is_done                           | BOOL          | NOT NULL, DEFAULT FALSE                         | Es-ce que l'histoire à eu lieu ?                                         |
| report                            | LONGTEXT      | NOT NULL                                        | Ce qui s'est déroulé quand l'histoire a été jouée                        |
| campaign_id                       | ENTITY        | NOT NULL                                        | Identifiant de la campagne correspondante                                |
| created_at                        | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de l'histoire                                        |
| updated_at                        | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour de l'histoire                         |