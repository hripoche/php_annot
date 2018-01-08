
LOAD DATA INFILE '/db/gene/DATA/gene2accession'
    INTO TABLE gene2accession
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (tax_id,
     gene_id,
     status,
     rna_nucleotide_accession,
     rna_nucleotide_gi,
     protein_accession,
     protein_gi,
     genomic_nucleotide_accession,
     genomic_nucleotide_gi,
     start_position_on_the_genomic_accession,
     end_position_on_the_genomic_accession,
     orientation,
     assembly);

LOAD DATA INFILE '/db/gene/DATA/gene2go'
    INTO TABLE gene2go
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    IGNORE 1 LINES
    (tax_id,gene_id,go_id,evidence,go_qualifier,go_term,pubmed_ids,category);

LOAD DATA INFILE '/db/gene/DATA/gene2pubmed'
    INTO TABLE gene2pubmed
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (tax_id,gene_id,pubmed_id);

LOAD DATA INFILE '/db/gene/DATA/gene2refseq'
    INTO TABLE gene2refseq
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (tax_id,
     gene_id,
     status,
     rna_nucleotide_accession,
     rna_nucleotide_gi,
     protein_accession,
     protein_gi,
     genomic_nucleotide_accession,
     genomic_nucleotide_gi,
     start_position_on_the_genomic_accession,
     end_position_on_the_genomic_accession,
     orientation,
     assembly);

LOAD DATA INFILE '/db/gene/DATA/gene2sts'
    INTO TABLE gene2sts
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    IGNORE 1 LINES
    (gene_id,unists_id);

LOAD DATA INFILE '/db/gene/DATA/gene2unigene'
    INTO TABLE gene2unigene
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (gene_id,unigene);

LOAD DATA INFILE '/db/gene/DATA/gene_history'
    INTO TABLE gene_history
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (tax_id,
     gene_id,
     discontinued_gene_id,
     discontinued_symbol,
     discontinued_date);

LOAD DATA INFILE '/db/gene/DATA/gene_info'
    INTO TABLE gene_info
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (tax_id,
     gene_id,
     symbol,
     locustag,
     synonyms,
     dbxrefs,
     chromosome,
     map_location,
     description,
     type_of_gene,
     symbol_from_nomenclature_authority,
     full_name_from_nomenclature_authority,
     nomenclature_status,
     other_designations,
     modification_date);

LOAD DATA INFILE '/db/gene/DATA/mim2gene'
    INTO TABLE mim2gene
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (mim_number,gene_id,type);

LOAD DATA INFILE '/db/gene/GeneRIF/generifs_basic'
    INTO TABLE generifs_basic
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    (tax_id,
     gene_id,
     pubmed_id,
     last_update_timestamp,
     gene_rif_text);
