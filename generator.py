import os
import sys

def generate(name):
    filename = f"app/controllers/{name.capitalize()}Controller.php"
    view_foldername = f"app/views/{name.lower()}/"
    if not os.path.exists(view_foldername):
        os.makedirs(view_foldername)
    content = f"""<?php
class {name.capitalize()}Controller {{
  const DEFAULT_VIEW_FOLDER = 'views/{name.lower()}/';
}}
?>
"""
    with open(filename, 'w') as file:
        file.write(content)
    print(f'Controller created: {filename}')

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print('Usage: python generator.py [controller_name]')
        sys.exit(1)

    generate(sys.argv[1])
