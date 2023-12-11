const exercices = {
   algo: {
      exo1: {
         ennoncé: "<p>Donner la somme des diviseur pour determiner si un nombre est parfait.</p>",
         code: `<div class="algo"><pre>
               Algo: perimetreSurfaceRectangle
               Declaration: LG,LR,P,
                  S: réel
               Début:
                  Afficher("Donner la largeur 1: ")
                  Saisir(LR)
                  Afficher("Donner la longeur 2: '')
                  Saisir(LG) P = LG * 2 + LR * 2 S = LG * LR
                  Afficher("Le périmetre du rectangle est de : '', P)
                  Afficher("La surface du rectangle est de : '', S)
               Fin perimetreSurfaceRectangle
            </pre></div>`
      },
      exo3:{
         ennoncé: "<p>Description de l'exo 3</p>",
         code: `<div class="algo"><pre>
         Algo : Diviseurs
         Déclaration
            nb, div : entier
         Début
            Afficher ("Donner un nombre entier : ")
            Saisir (nb)

            div <- 1
            Tant que div <= nb faire
               Si nb % div = 0
                  Alors Afficher("Diviseur : ", div)
               Finsi
               div <- div + 1
            Fin tant que
         Fin Diviseurs
         </pre></div>`
      },
      exo4:{
         ennoncé: "<p>Ecrire un algo qui permet de saisir deux limites et détermine tous les nombres parfaits compris entre les deux limites. Exemple entre 1 et 30 : les nombres parfaits sont 6 et 28.</p>",
         code: `<div class="algo"><pre>
         Algo : liste_parfaits
         Déclaration
            nb, div, somme, lim1, lim2 : entier
         Début
            afficher("La première limite :")
            saisir (lim1)
            afficher("La deuxième limite : ")
            saisir (lim2)
            Pour nb allant de lim1 à lim2 faire
               somme <- 0
               div <- 1
               tant que div < nb faire
                  si nb % div = 0
                     alors somme <- div + somme
                  finsi
                  div <- div + 1
               fin Tant que
               si nb = somme
                  alors afficher (nb, " est nombre parfait")
               finsi
            Fin Pour
         Fin liste_parfaits
         </pre></div>`
      },
      exo5:{
         ennoncé: "<p>Ecrire un Algo qui permet de saisir dix prix et affiche le prix moyen.</p>",
         code: `<div class="algo"><pre>
         Algo : Prix_moyen
         Déclaration
            prix, somme, moyen : réel
            i : entier
         Début
            somme <- 0
            Pour i allant de 1 à 10 faire
               afficher("Donner un prix : ")
               saisir (prix)
               somme <- prix + somme
            Fin pour
            moyen <- somme / 10
            afficher ("le prix moyen est de : ", moyen)
         Fin Prix_moyen
         </pre></div>`
      },
      exo6: {
         ennoncé: "<p>Ecrire un algo puis un prog C qui saisi un entier et affiche s'il est pair ou impair.</p>",
         code: `<div class="algo"><pre>
               Algo : pair_impair
               Déclaration
                  n : entier
               Début
                  Afficher("Donner un entier :")
                  saisir (n)
                  Si n % 2 = 0
                     alors afficher(n, " est un nombre pair")
                     sinon afficher (n, " est un nombre impair")
                  Finsi
               Fin pair_impai
            </pre></div>`
      },
      exo7: {
         ennoncé: "<p>Ecrire un algo /C/ PHP qui permet de résoudre dans R l'equation du premier degre a*x +b = 0.</p>",
         code: `<div class="algo"><pre>
               algo : equation1
               Déclaration
                  a, b, x : réel
               Début
                  Afficher("Donner le premier coeff :")
                  saisir (a)
                  afficher ("Donner le deuxième coeff : ")
                  saisir (b)
                  si a = 0
                     alors si b = 0
                        alors afficher("Ensemble des solutions est R")
                        sinon afficher("Ensemble des solutions est vide")
                     finsi
                     sinon
                        x <- (-b/a)
                        afficher("Solution : ", x)
                  finsi
               fin equation1
            </pre></div>`
      },
      exo8: {
         ennoncé: "<p>Ecrire un algo /C/ PHP qui permet de résoudre dans R l'equation du second degre a*x2+b*x +c = 0.</p>",
         code: `<div class="algo"><pre>
            Algo : equation2
            Déclaration
               a,b,c,d, x, x1, x2 : réel
            Début
               Afficher("Donner le premier coeff :")
               saisir (a)
               Afficher ("Donner le deuxième coeff : ")
               saisir (b)
               Afficher ("Donner le troisième coeff : ")
               saisir (c)
               Si a = 0
                  alors Si b = 0
                        Alors Si c = 0
                              Alors Afficher ("Ens des solutions est R ")
                              Sinon Afficher ("Ens des solutions est  vide")
                           Finsi
                        Sinon
                              x <- (-c/b)
                              Afficher ("La solution est : ", x)
                     Finsi
                  Sinon
                     d <- b*b - 4*a*c
                     Si d < 0
                        Alors Afficher ("Ens des solutions est  vide")
                        Sinon Si d = 0
                              Alors
                                 x <- (-b/2*a)
                                 Afficher ("La solution est : ", x)
                              Sinon
                                 x1 <- (-b + sqrt(d)) / (2*a)
                                 x2 <- (-b - sqrt(d)) / (2*a)
                                 Afficher ("Solution 1 : ", x1)
                                 Afficher ("Solution 2 : ", x2)
                           Finsi
                     Finsi
               Finsi
            </pre></div>`
      },
      exo10: {
         ennoncé: "<p>Un nombre est dit parfait s'il est égal à la somme de ses diviseurs sauf lui-même. Écrire une fonction qui permet de recevoir un entier et retourne la somme de ses diviseurs sauf lui-même. Écrire un programme qui saisit un entier et fait appel à la fonction pour tester si le nombre est parfait.</p>",
         code: `<div class="algo"><pre>
            Algo : equation2
            Déclaration
               a,b,c,d, x, x1, x2 : réel
            Début
               Afficher("Donner le premier coeff :")
               saisir (a)
               Afficher ("Donner le deuxième coeff : ")
               saisir (b)
               Afficher ("Donner le troisième coeff : ")
               saisir (c)
               Si a = 0
                  alors Si b = 0
                        Alors Si c = 0
                              Alors Afficher ("Ens des solutions est R ")
                              Sinon Afficher ("Ens des solutions est  vide")
                           Finsi
                        Sinon
                              x <- (-c/b)
                              Afficher ("La solution est : ", x)
                     Finsi
                  Sinon
                     d <- b*b - 4*a*c
                     Si d < 0
                        Alors Afficher ("Ens des solutions est  vide")
                        Sinon Si d = 0
                              Alors
                                 x <- (-b/2*a)
                                 Afficher ("La solution est : ", x)
                              Sinon
                                 x1 <- (-b + sqrt(d)) / (2*a)
                                 x2 <- (-b - sqrt(d)) / (2*a)
                                 Afficher ("Solution 1 : ", x1)
                                 Afficher ("Solution 2 : ", x2)
                           Finsi
                     Finsi
               Finsi
            </pre></div>`
      },
   },
   php: {
      exo1: {
         ennoncé: "<p>Donner la somme des diviseur pour determiner si un nombre est parfait.</p>",
         code: `<iframe class="code"
                src=" https://phpsandbox.io/e/x/m1pag?layout=EditorPreview&defaultPath=%2F&theme=dark&showExplorer=no&openedFiles=no"
                style="display: block"
                loading="lazy"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                height="100%"
                width="100%" >
            </iframe>`,
      },
      exo2: {
         ennoncé: "<p>Description de l'exo 2</p>",
         code: `<iframe class="code"
                src="https://phpsandbox.io/e/x/qgc31?&layout=EditorPreview&iframeId=xds3d4utc&theme=dark&defaultPath=/&showExplorer=no"
                style="display: block"
                loading="lazy"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                height="100%"
                width="100%" >
            </iframe>`,
      },
      exo3: {
         ennoncé: "<p>Description de l'exo 3</p>",
         code: `<iframe class="code"
                src="https://phpsandbox.io/e/x/qgc31?&layout=EditorPreview&iframeId=xds3d4utc&theme=dark&defaultPath=/&showExplorer=no"
                style="display: block"
                loading="lazy"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                height="100%"
                width="100%" >
            </iframe>`,
      }
   },
   c: {
      exo1: {
         ennoncé: "<p>Description de l'exo 1</p>",
         code: `<iframe src="https://replit.com/@LMN-i-code/exo1?embed=true#main.c"
         style="width: 1px;max-width: 100%;min-width: 100%;overflow: hidden;"
         width="100%" height="100%"
         loading="lazy"
         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
           />`
      },
      exo3:{
         ennoncé: "<p>Description de l'exo 3</p>",
         code: `<iframe src="https://replit.com/@LMN-i-code/exo1?embed=true#main.c">`
      },
      exo3: {
         ennoncé: "<p>Ecrire un algo puis un prog C qui saisi un entier et affiche s'il est pair ou impair.</p>",
         code: `<iframe class="code"
         src="https://replit.com/@LMN-i-code/exo3?embed=true#main.c"
         style="display: block"
         loading="lazy"
         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
         height="100%"
         width="100%">
     </iframe>`
      },
      exo4: {
         ennoncé: "<p>Ecrire un algo /C/ PHP qui permet de résoudre dans R l'equation du premier degre a*x +b = 0.</p>",
         code: `<iframe class="code"
                src="https://replit.com/@LMN-i-code/exo2?embed=true#main.c"
                style="display: block"
                loading="lazy"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                height="100%"
                width="100%">
            </iframe>`
      },
      exo5: {
         ennoncé: "<p>Ecrire un algo /C/ PHP qui permet de résoudre dans R l'equation du second degre a*x2+b*x +c = 0.</p>",
         code: `<iframe class="code"
         src="https://replit.com/@LMN-i-code/exo4?embed=true#main.c"
         style="display: block"
         loading="lazy"
         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
         height="100%"
         width="100%">
     </iframe>`
      },
      exo6: {
         ennoncé: "<p>Un nombre est dit parfait s'il est égal à la somme de ses diviseurs sauf lui-même. Écrire une fonction qui permet de recevoir un entier et retourne la somme de ses diviseurs sauf lui-même. Écrire un programme qui saisit un entier et fait appel à la fonction pour tester si le nombre est parfait.</p>",
         code: `<iframe class="code"
         src="https://replit.com/@LMN-i-code/exo6?embed=true#main.c"
         style="display: block"
         loading="lazy"
         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
         height="100%"
         width="100%">
     </iframe>`
      },
      exo7: {
         ennoncé: "<p>Ecrire une fonction qui reçoit en entrée un nombre entier et un exposant et calcule la puissance du nombre par l'exposant en faisant des multiplications successives. puissance (a, b) = a*a*a*a….*a (b fois).</p>",
         code: `<iframe class="code"
         src="https://replit.com/@LMN-i-code/exo7?embed=true#main.c"
         style="display: block"
         loading="lazy"
         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
         height="100%"
         width="100%">
     </iframe>`,
      },
      exo8: {
         ennoncé: "<p>Ecrire une procédure qui affiche la table de multiplication d'un nombre reçu en entrée et d'une limite de la table. Écrire une main qui utilise cette procédure.</p>",
         code: `<iframe class="code"
         src="https://replit.com/@LMN-i-code/exo8?embed=true#main.c"
         style="display: block"
         loading="lazy"
         allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
         height="100%"
         width="100%">
     </iframe>`
      }
   }
}

function doSomething(el) {
   document.querySelectorAll(".item").forEach(function (el) {
      el.classList.remove("active");
   });
   el.classList.toggle("active");
}

function doSomethingElse(el) {
   document.querySelectorAll(".type").forEach(function (el) {
      el.classList.remove("active");
   });
   el.classList.toggle("active");
   showCode();
}
function doSomeOtherthing(el) {
   document.querySelectorAll(".exo").forEach(function (el) {
      el.classList.remove("active");
   });
   el.classList.toggle("active");
   showCode();
}
function showCode() {
   const code = document.querySelector(".playground");
   const enoncer = document.querySelector(".enoncer");
   const type = document.querySelector(".type.active");
   const exo = document.querySelector(".exo.active");
   const exoValue = exo.getAttribute("data-exo")
   const typeValue = type.getAttribute("data-type")
   enoncer.innerHTML = exercices[typeValue][exoValue].ennoncé;
}
window.onload = function () {
   showCode();
}