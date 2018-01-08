
create table gene2accession
(tax_id varchar(20),
 gene_id varchar(20),
 status varchar(20),
 rna_nucleotide_accession varchar(20),
 rna_nucleotide_gi varchar(20),
 protein_accession varchar(20),
 protein_gi varchar(20),
 genomic_nucleotide_accession varchar(20),
 genomic_nucleotide_gi varchar(20),
 start_position_on_the_genomic_accession varchar(20),
 end_position_on_the_genomic_accession varchar(20),
 orientation varchar(1),
 assembly text,
 key(gene_id));

create table gene2go
(tax_id varchar(20),
 gene_id varchar(20),
 go_id text,
 evidence text,
 go_qualifier text,
 go_term text,
 pubmed_ids text,
 category text,
 key(gene_id));

create table gene2pubmed
(tax_id varchar(20),
 gene_id varchar(20),
 pubmed_id varchar(20),
 key(gene_id));

create table gene2refseq
(tax_id varchar(20),
 gene_id varchar(20),
 status varchar(20),
 rna_nucleotide_accession varchar(20),
 rna_nucleotide_gi varchar(20),
 protein_accession varchar(20),
 protein_gi varchar(20),
 genomic_nucleotide_accession varchar(20),
 genomic_nucleotide_gi varchar(20),
 start_position_on_the_genomic_accession varchar(20),
 end_position_on_the_genomic_accession varchar(20),
 orientation varchar(1),
 assembly text,
 key(gene_id));

create table gene2sts
(gene_id varchar(20),
 unists_id varchar(20),
 key(gene_id));

create table gene2unigene
(gene_id varchar(20),
 unigene varchar(20),
 key(gene_id));

create table gene_history
(tax_id varchar(20),
 gene_id varchar(20),
 discontinued_gene_id varchar(20),
 discontinued_symbol varchar(40),
 discontinued_date varchar(8),
 key(gene_id));

create table gene_info
(tax_id varchar(20),
 gene_id varchar(20),
 symbol text,
 locustag text,
 synonyms text,
 dbxrefs text,
 chromosome text,
 map_location text,
 description text,
 type_of_gene text,
 symbol_from_nomenclature_authority text,
 full_name_from_nomenclature_authority text,
 nomenclature_status text,
 other_designations text,
 modification_date varchar(8),
 key(gene_id));

create table mim2gene
(mim_number varchar(20),
 gene_id varchar(20),
 type varchar(20),
 key(gene_id));

create table generifs_basic
(tax_id varchar(20),
 gene_id varchar(20),
 pubmed_id varchar(255),
 last_update_timestamp varchar(40),
 gene_rif_text text,
 key(gene_id));
