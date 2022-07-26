Tests <- read.csv("D:\\Wali\\amrbd_datbasein_csv\\STATICBAHIS_summarizeipersampletests_202207251225.csv", header=TRUE, stringsAsFactors=FALSE)
Samples <- read.csv("D:\\Wali\\amrbd_datbasein_csv\\STATICBAHIS_summarizeipersamples_202207251225.csv", header=TRUE, stringsAsFactors=FALSE)
Antibiotics <- read.csv("D:\\Wali\\amrbd_datbasein_csv\\STATICBAHIS_antibiotics_202207251225.csv", header=TRUE, stringsAsFactors=FALSE)
Pathogens <- read.csv("D:\\Wali\\amrbd_datbasein_csv\\STATICBAHIS_pathogen_202207251225.csv", header=TRUE, stringsAsFactors=FALSE)
Species <- read.csv("D:\\Wali\\amrbd_datbasein_csv\\STATICBAHIS_species_202207251225.csv", header=TRUE, stringsAsFactors=FALSE)
Specimen <- read.csv("D:\\Wali\\amrbd_datbasein_csv\\STATICBAHIS_specimens_202207251225.csv", header=TRUE, stringsAsFactors=FALSE)


TestsUpdated <- merge(x=Tests,y=Antibiotics,by="antibiotic_id",all.x=TRUE)
TestsUpdated_1 <- merge(x = TestsUpdated, y = Pathogens, by = "pathogen_id", all.x = TRUE)
TestsUpdated_2 <- merge(x = TestsUpdated_1, y = Samples, by = "sample_id", all.x = TRUE)

TestsCleaned = subset(TestsUpdated_2, select = -c(pathogen_id.x, created_by.x, created_at.x, 
                                                  updated_at.x, created_by.y, created_at.y,
                                                  pathogen_id.y, updated_at.y))
TestsCleaned_1 = subset(TestsCleaned, select = -c(created_by.x, created_at.x, 
                                                  updated_at.x, created_by.y, created_at.y,
                                                  updated_at.y, sensitivity_pattern))

TestsUpdated_3 <- merge(x = TestsCleaned_1, y = Species, by = "species_id", all.x = TRUE)
TestsUpdated_4 <- merge(x = TestsUpdated_3, y = Specimen, by = "specimen_id", all.x = TRUE)

TestsCleaned_2 = subset(TestsUpdated_4, select = -c(created_by.x, created_at.x, 
                                                  updated_at.x, created_by.y, created_at.y, 
                                                  updated_at.y))


#Trying out the AMR tool
library(dplyr)
library(ggplot2)
library(AMR)
library(cleaner)

# All comes out as false 
is.rsi.eligible(TestsCleaned_2)
colnames(TestsCleaned_2)[is.rsi.eligible(TestsCleaned_2)]

# Nothing changed in the database after this check
Analysis <- eucast_rules(TestsCleaned_2, col_mo = "pathogen_name", rules = "all")


Mutatae <- Analysis %>%
  mutate(pathogen_name = as.mo(pathogen_name))

is.rsi.eligible(Mutatae)
colnames(Mutatae)[is.rsi.eligible(Mutatae)]

Mutated <- Mutatae %>%
  mutate(across(where(is.rsi.eligible), as.rsi))

#Trying out bug-drug combination

Mutated %>% 
  bug_drug_combinations(
    x = antibiotic_name,
    col_mo = pathogen_name,
    FUN = mo_shortname(
      x,
      language = get_AMR_locale(),
      minimum = 30,
      combine_SI = FALSE,
      combine_IR = FALSE,
      remove_intrinsic_resistant = FALSE,
      decimal.mark = getOption("OutDec"),
      big.mark = ifelse(decimal.mark == ",", ".", ",")
      
    )
  ) %>% 
  head()
