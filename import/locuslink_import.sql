
LOAD DATA INFILE '/db/locuslink/Lkfunc'
    INTO TABLE locuslink
    FIELDS TERMINATED BY '\t'
    LINES TERMINATED BY '\n'
    IGNORE 1 LINES
(locus_id,
 locus_symbol,
 refseq_NM,
 refseq_NT,
 unigene,
 genbank_accession,
 symbol_alias,
 description,
 omim,
 location,
 pfam_cdd,
 pfam_id,
 go_terms,
 go_accessions,
 pubmed,
 refseq_XM,
 refseq_NG,
 swissprot_accession,
 homologene,
 refseq_NP,
 chr1,
 start_position,
 end_position,
 orientation,
 location_goldenpath,
 location2,
 nb_exons,
 chr2
);
