# Instalar e carregar pacotes necessários
install.packages("tidyr")
install.packages("dplyr")

library(tidyr)
library(dplyr)

# Ler os dados em CSV
dados <- read.csv("dados.csv")

# Transpor os dados
dados_transpostos <- dados %>%
  pivot_wider(
    names_from  = form_key, 
    values_from = data
  )

# Ler os arquivos em CSV
arquivos <- read.csv("arquivos.csv")

# Ajustar nome da coluna e tipo de dado
arquivos <- arquivos %>% rename(arquivo_do_trabalho = fid)
arquivos$arquivo_do_trabalho <- as.character(arquivos$arquivo_do_trabalho)

# Juntar os data frames usando a coluna em comum
dados_transpostos <- left_join(
  dados_transpostos, 
  arquivos, 
  by = "arquivo_do_trabalho"
)

# Salvar os dados transpostos em um novo arquivo CSV
write.csv(
  dados_transpostos, 
  "dados_transpostos.csv", 
  row.names = FALSE
)

#################################### FIM #######################################