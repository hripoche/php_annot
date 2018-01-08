create database annot_mrm;

use annot_mrm;

create table protein_info
(protein_id integer NOT NULL auto_increment,
 user_name text,
 user_description text,
 date date,
 project_name text,
 sample_name text,
 analysis_method text,
 validation_method text,
 protein_filename text,
 peptide_filename text,
 primary key(protein_id));

create table protein_line
(protein_id integer NOT NULL,
 protein_line_id integer NOT NULL auto_increment,
 num_spectra integer,
 mean_intensity double,
 protein_mw double,
 protein_pi double,
 species text,
 accession_number text,
 percent_coverage integer,
 num_peps_unique integer,
 score_unique double,
 heavy_over_light_ratio double,
 stddev_heavy_over_light_ratio double,
 num_hl_ratios integer,
 group_num integer,
 num_subgroups integer,
 entry_name text,
 key(protein_id),
 primary key(protein_id,protein_line_id));

create table peptide_line
(protein_id integer NOT NULL,
 peptide_line_id integer NOT NULL auto_increment,
 # number integer,
 filename text,
 parent_charge integer,
 score double,
 percent_scored_peak_intensity double,
 # deltaApexRetentionTimeSec
 total_intensity bigint,
 # numMergedScans
 sequence text,
 modifications text,
 hl double,
 retention_time_min double,
 parent_m_over_z double,
 matched_parent_mass double,
 peptide_pi double,
 protein_mw double,
 protein_pi double,
 species text,
 accession_number text,
 entry_name text,
 key(protein_id),
 primary key(protein_id,peptide_line_id));

##grant all privileges on `annot_mrm`.* to 'ripoche'@'localhost';
