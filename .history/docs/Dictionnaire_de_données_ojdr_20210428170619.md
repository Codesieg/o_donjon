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
| class_id                          | entity        | NULL                                            | La class du personnage                           |
| stats_id                          | entity        | NULL                                            | Le status du personnage                          |
| saving_throws_id                  | entity        | NULL                                            | Le dés de sauvegarde du personnage               |
| skill_id                          | entity        | NULL                                            | Les compétences du personnage                    |
| race_id                           | entity        | NULL                                            | La race du personnage                            |
| created_at                        | TIMESTAMP     | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création du personnage                |
| updated_at                        | TIMESTAMP     | NULL                                            | La date de la dernière mise à jour du personnage |

## Statistiques (`stats`)

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


## Sorts (`spells`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| spellcasting_class                | VARCHAR(64)   | NULL                                            | Nom de classe du lançeur de sort (invocateur, élémentaliste)             |
| spell_attack_bonus                | INT           | NOT NULL, DEFAULT 0                             | Bonus d'attaque d'un sort                                                |
| spellcasting_ability              | INT           | NOT NULL, DEFAULT 0                             | Caractéristique principale liée au sort                                  |
| spell_save_dc                     | INT           | NOT NULL, DEFAULT 0                             | Résistance à la magie                                                    |
| spells_list                       | LONGTEXT      | NOT NULL                                        | Liste des sorts du personnage                                            |

## Jets de sauvegardes  (`saving_throws `)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| strength                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de force                    |
| dexterity                         | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de dexterité                |
| constitution                      | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de constitution             |
| intelligence                      | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de intelligence             |
| wisdom                            | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de sagesse                  |
| charisma                          | BOOL          | NOT NULL, DEFAULT FALSE                         | Jet de sauvegarde de charisme                 |

## Compétences  (`skill `)

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

## Race  (`race`)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| nom                               | VARCHAR(64)   | NOT NULL                                        | Nom de la race                                |
| informations                      | VARCHAR(64)   | NOT NULL                                        | Déscriptif de la race                         |

## Classe  (`class`)

| Champ                             | Type          | Spécificités                                    | Description                                   |
| --------------------------------- | ------------- | ----------------------------------------------- | --------------------------------------------- |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                   |
| nom                               | VARCHAR(64)   | NOT NULL                                        | Nom de la class                               |
| informations                      | VARCHAR(64)   | NOT NULL                                        | Déscriptif de la class                        |

## Modifiers (`modifiers`)

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


## Campagnes (`Campaigns`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | INT           | NOT NULL                                        | Nom de la campagne                                                       |
| Description                       | INT           | NOT NULL                                        | Histoire de la campagne                                                  |

## Utilisateurs (`user`)

| Champ                              | Type                                     | Spécificités                                    | Description                                                              |
| ---------------------------------- | ---------------------------------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                 | INT                                      | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de notre utilisateur                                       |
| email                              | VARCHAR(64)                              | NOT NULL, UNIQUE                                | L'email de l'utilisateur                                                 |
| password                           | VARCHAR(64)                              | NOT NULL                                        | Le mot de passe de l'utilisateur                                         |
| pseudo                             | VARCHAR(64)                              | NOT NULL                                        | Le pseudo de l'utilisateur                                               |
| avatar                             | VARCHAR(64)                              | NULL                                            | La photo d'avatar de l'utilisateur                                       |
| role                               | ENUM('admin', 'DM', 'Player',)           | NOT NULL, DEFAULT 'reader'                      | Le rôle de l'utilisateur                                                 |
| status                             | TINYINT(3)                               | NOT NULL, DEFAULT 0                             | Le statut de l'utilisateur (1=actif, 2=désactivé/bloqué)                 |
| created_at                         | TIMESTAMP                                | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création du compte utilisateur                                |
| updated_at                         | TIMESTAMP                                | NULL                                            | La date de la dernière mise à jour de l'utilisateur                      |

## Monstres (`Monsters`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | INT           | NOT NULL                                        | Nom du monstre                                                           |
| Description                       | INT           | NOT NULL                                        | Description du monstre                                                   |

## NPC (`npc`)

| Champ                             | Type          | Spécificités                                    | Description                                                              |
| --------------------------------- | ------------- | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id                                | INT           | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | Identifiant                                                              |
| name                              | INT           | NOT NULL                                        | Nom du NPC                                                               |
| Description                       | INT           | NOT NULL                                        | Description du NPC                                                       |