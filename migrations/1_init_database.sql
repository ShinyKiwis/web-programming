CREATE TABLE `Users` (
  `id` integer PRIMARY KEY,
  `type` string,
  `username` string,
  `password` string,
  `email` string
);

CREATE TABLE `Companies` (
  `id` integer PRIMARY KEY,
  `name` string,
  `description` string,
  `size` integer,
  `contact_info` integer,
  `address` string,
  `owner_id` integer
);

CREATE TABLE `Jobs` (
  `id` integer PRIMARY KEY,
  `name` string,
  `description` string,
  `requirements` string,
  `salary` string,
  `expiration` date,
  `location` string,
  `benefits` string,
  `company_id` integer
);

CREATE TABLE `JobsTags` (
  `job_id` integer,
  `tag_id` integer,
  PRIMARY KEY (`job_id`, `tag_id`)
);

CREATE TABLE `Tags` (
  `id` integer PRIMARY KEY,
  `name` string
);

CREATE TABLE `CVs` (
  `id` integer PRIMARY KEY,
  `career_goal` string,
  `experiences` string,
  `degrees` string,
  `skills` string[],
  `languages` string[],
  `owner_id` integer,
  `willing_to_relocation` boolean,
  `location` string
);

CREATE TABLE `JobsCVs` (
  `job_id` integer,
  `cv_id` integer,
  PRIMARY KEY (`job_id`, `cv_id`)
);

CREATE TABLE `CVsSkills` (
  `cv_id` integer,
  `skill_id` integer,
  PRIMARY KEY (`cv_id`, `skill_id`)
);

CREATE TABLE `Skills` (
  `id` integer PRIMARY KEY,
  `title` string,
  `year_of_experiences` number
);

ALTER TABLE `Companies` ADD FOREIGN KEY (`owner_id`) REFERENCES `Users` (`id`);

ALTER TABLE `JobsTags` ADD FOREIGN KEY (`job_id`) REFERENCES `Jobs` (`id`);

ALTER TABLE `JobsTags` ADD FOREIGN KEY (`tag_id`) REFERENCES `Tags` (`id`);

ALTER TABLE `CVsSkills` ADD FOREIGN KEY (`cv_id`) REFERENCES `CVs` (`id`);

ALTER TABLE `CVsSkills` ADD FOREIGN KEY (`skill_id`) REFERENCES `Skills` (`id`);

ALTER TABLE `JobsCVs` ADD FOREIGN KEY (`cv_id`) REFERENCES `CVs` (`id`);

ALTER TABLE `JobsCVs` ADD FOREIGN KEY (`job_id`) REFERENCES `Jobs` (`id`);

ALTER TABLE `Jobs` ADD FOREIGN KEY (`company_id`) REFERENCES `Companies` (`id`);

ALTER TABLE `CVs` ADD FOREIGN KEY (`owner_id`) REFERENCES `Users` (`id`);
