# Devo verificare che all'interno del file dove viene chiamata la funzione <?php system("check_attack.py /this_page.php");?>
# sia presente un tag <script>

import sys
import re
import os
import html
from bs4 import BeautifulSoup

def check_attack(file_path):
    # Verifica se il file esiste
    if not os.path.exists(file_path):
        return

    # Legge il contenuto del file
    with open(file_path, 'r') as file:
        content = file.read()
        
        decoded_content = html.unescape(content)
        soup = BeautifulSoup(decoded_content, 'html.parser')
        
        # Controlla se ci sono tag <script>
        if soup.find_all('script'):
            print(os.getenv("FLAG", "FLAG{default_flag}"))
            
    file.close()

if __name__ == "__main__":
    if len(sys.argv) != 2:
        sys.exit(1)
    file_path = sys.argv[1]
    check_attack(file_path)
