# Devo verificare che all'interno del file dove viene chiamata la funzione <?php system("check_attack.py /this_page.php");?>
# sia presente un tag <script>

import sys
import re
import os
import html
from bs4 import BeautifulSoup
import requests

def check_attack(url):

    response = requests.get(url)
    if response.status_code != 200:
        print("Failed to fetch the page.")
        return

    # Decodifica HTML entities (es: &colon; -> :, &#58; -> :)
    decoded_content = html.unescape(response.text)
    soup = BeautifulSoup(decoded_content, 'html.parser')

    # Controlla se ci sono tag <script>
    if soup.find_all('script'):
        print(os.getenv("FLAG", "FLAG{default_flag}"))


if __name__ == "__main__":
    if len(sys.argv) != 2:
        sys.exit(1)
    url = sys.argv[1]
    check_attack(url)
