function yesnoCheck() {
                            if (document.getElementById('noCheck').checked) {
                               document.getElementById('ifYes').style.visibility = 'visible';
                               document.getElementById('yes').setAttribute('required','');
                            }
                            else if (document.getElementById('yesCheck').checked) {
                              document.getElementById('ifYes').style.visibility = 'hidden';
                              document.getElementById('yes').removeAttribute('required');
                            }
        }