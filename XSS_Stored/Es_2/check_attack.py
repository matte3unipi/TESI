# Devo verificare che all'interno del file dove viene chiamata la funzione <?php system("check_attack.py /this_page.php");?>
# $input=javascript:alert(1) BLOCCATA
# $input=javascript&x??;alert(1) PASSA ED ESEGUE

import sys
import re
import os
import html
from bs4 import BeautifulSoup

def check_attack(file_path):
    # Verifica se il file esiste
    if not os.path.exists(file_path):
        return

    with open(file_path, 'r') as file:
        content = file.read()

        # Decodifica HTML entities (es: &colon; -> :, &#58; -> :)
        decoded_content = html.unescape(content)
        soup = BeautifulSoup(decoded_content, 'html.parser')

        # Controlla se ci sono tag <a> con href che inizia con "javascript:"
        for tag in soup.find_all('a', href=True):
            elem = tag['href'].strip().lower()
            if elem.startswith("javascript:"):
                print(os.getenv("FLAG", "FLAG{default_flag}"))
                break
    file.close()

if __name__ == "__main__":
    if len(sys.argv) != 2:
        sys.exit(1)
    file_path = sys.argv[1]
    check_attack(file_path)
