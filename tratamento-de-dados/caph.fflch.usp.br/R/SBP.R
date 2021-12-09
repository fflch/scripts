rm(list = ls())
setwd("~/repos/scripts/tratamento-de-dados/caph.fflch.usp.br/")

dados <- read.csv("data/SBP.csv")

## investigando colunas
dados$Fundo = '16616'

# Corrigindo grafia das Técnica *** Múltiplos valores ***
dados$Técnica = gsub("Fotografia analógica","Fotografia Analógica",dados$Técnica)
dados$Técnica = gsub('impressão','Impressão',dados$Técnica)
dados$Técnica = gsub(' Impressão','Impressão',dados$Técnica)
dados$Técnica = gsub('Impressão ','Impressão',dados$Técnica)
dados$Técnica = gsub(' Manuscritura','Manuscritura',dados$Técnica)
dados$Técnica = gsub(' Mimeografia','Mimeografia',dados$Técnica)
unicos = unique(unlist(strsplit(paste(unique(dados$Técnica),collapse = ','),',')))
unicos = paste(unicos,unicos,sep='|')
write.csv(file="/tmp/tmp.csv",unicos,row.names = F,quote = F)

# suporte
dados$Suporte = gsub('papel','Papel',dados$Suporte)
unique(dados$Suporte)
write.csv(file="/tmp/tmp.csv",unique(dados$Suporte))

# Formato
unique(dados$Formato)
write.csv(file="/tmp/tmp.csv",unique(dados$Formato))

# Cromia 
dados$Cromia = gsub('preto e branco','Preto e Branco',dados$Cromia)
dados$Cromia = gsub('Preto e branco','Preto e Branco',dados$Cromia)
unique(dados$Cromia)
write.csv(file="/tmp/tmp.csv",unique(dados$Cromia))

# Idioma *** Múltiplos valores ***
unique(dados$Idioma)
dados$Idioma = gsub(' ','',dados$Idioma)
dados$Idioma = gsub('Fracês','Francês',dados$Idioma)
unicos = unique(unlist(strsplit(paste(unique(dados$Idioma),collapse = ','),',')))
unicos = paste(unicos,unicos,sep='|')
write.csv(file="/tmp/tmp.csv",unicos,row.names = F,quote = F)

# Descritores
dados$Descritores = paste(dados$Descritores,dados$Descritores.1,dados$Descritores.2,dados$Descritores.3,paste="|")

write.csv(file="outputs/SBP.csv",dados,row.names = F)
colnames(dados)


