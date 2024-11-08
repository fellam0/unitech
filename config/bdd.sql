CREATE DATABASE bdd_projet;
USE bdd_projet;
CREATE TABLE etudiant (
    id VARCHAR(7) PRIMARY KEY,
    nom_utilisateur VARCHAR(255) UNIQUE,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255),
    systeme VARCHAR(50),
    niveau VARCHAR(50),
    specialite VARCHAR(50),
    demande_reinitialisation BOOLEAN DEFAULT FALSE,
    code_reinitialisation VARCHAR(6),
    expiration_code_reinitialisation DATETIME, 
    photo_profil VARCHAR(255),
);
/*mdp compte user1:User2000
mdp compte user2:User2001
mdp compte messi:Raphinha2000 */

CREATE TABLE admin(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom_utilisateur VARCHAR(255) unique,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255)
);
INSERT INTO admin (nom_utilisateur,nom,prenom,email,mot_de_passe)
 VALUES ('admin','admin','admin','admin@gmail.com',PASSWORD('1234')),
  ('admin1','sam','leo','admin1@gmail.com',PASSWORD('admin'));
CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    langue VARCHAR(20) NOT NULL,
    description TEXT,
    pdf VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL
);
INSERT INTO livres (id,titre,langue,description, pdf, image) 
VALUES (1,'Data Structures With Java', 'anglais', 'Explorez les fondements des structures de données avec Java grâce à ce guide concis. Idéal pour les étudiants et les développeurs, il offre des explications claires et des exemples pratiques pour maîtriser les concepts essentiels de la programmation orientée objet', '../static/pdf/livres/data-structures-with-java.pdf', '../static/img/livres/data-structures-with-java.jpg'),
(2,'Beginning AngularJs', 'anglais', "Apprenez à créer des applications Web à l'aide d'AngularJS, l'un des frameworks Javascript les plus innovants du Web.", '../static/pdf/livres/beginning-angularjs.pdf', '../static/img/livres/beginning-angularjs.jpg'),
(3,'Developing 2D Games With Unity', 'anglais', "Apprenez à créer des jeux 2D avec Unity, en mettant l'accent sur la programmation avec C#. Les participants apprendront les bases du développement de jeux indépendants, y compris la création de graphismes et la gestion des interactions joueur-environnement.", '../static/pdf/livres/developing-2d-games-with-unity.pdf', '../static/img/livres/developing-2d-games-with-unity.jpg'),
(4,'Expert PHP And MySQL', 'anglais', "Expert PHP and MySQL Application Design and Development est un guide pratique pour les développeurs, couvrant les meilleures pratiques et techniques avancées pour créer des applications web robustes avec PHP et MySQL.", '../static/pdf/livres/Expert-PHP-and-MySQL.pdf', '../static/img/livres/Expert-PHP-and-MySQL.png'),
(5,'Html Css All In One', 'anglais', "HTML CSS All in One est une ressource complète pour les débutants et les développeurs expérimentés, offrant une couverture exhaustive de HTML et CSS. Avec des explications claires, des exemples pratiques et des conseils utiles, ce livre est un compagnon idéal pour apprendre et maîtriser la création de sites web dynamiques et attrayants.", '../static/pdf/livres/html-css-all-in-one.pdf', '../static/img/livres/html-css-all-in-one.png'),
(6,'Introduction To Assembly Language Programming', 'anglais', "Introduction to Assembly Language Programming est un guide clair et détaillé pour les débutants. Il offre une introduction aux concepts fondamentaux de l'assemblage avec des exemples pratiques et des exercices. Idéal pour les étudiants en informatique et les passionnés de programmation.", '../static/pdf/livres/Introduction-to-Assembly-Language-Programming.pdf', '../static/img/livres/Introduction-to-Assembly-Language-Programming.png'),
(7,'Python en Français', 'français', "Ce livre est conçu pour aider les biologistes à apprendre Python, un langage de programmation essentiel pour analyser des données, modéliser des systèmes et automatiser des tâches en biologie. Python est choisi pour sa simplicité, sa lisibilité et ses nombreuses bibliothèques adaptées à la science des données et à la bioinformatique.", '../static/pdf/livres/cours-python-fr.pdf', '../static/img/livres/cours-python-fr.png'),
(8,'JavaScript Book For Impatient Programmers', 'anglais', "Dans cette livre, l'accent est mis sur l'apprentissage rapide et efficace de JavaScript, en soulignant la pertinence et la polyvalence du langage pour le développement web.", '../static/pdf/livres/javascript-book.pdf', '../static/img/livres/javascript-book.png'),
(9,'Learning Python', 'anglais', "Ce livre, 'Learning Python', est une ressource essentielle pour tous ceux qui veulent maîtriser Python, l'un des langages de programmation les plus populaires et polyvalents d'aujourd'hui. Que vous soyez un débutant en programmation ou un développeur expérimenté souhaitant ajouter Python à vos compétences, ce guide vous offre une couverture complète des concepts fondamentaux et avancés de Python.", '../static/pdf/livres/Learning-Python.pdf', '../static/img/livres/Learning-Python.png'),
(10,'Matlab Object Oriented Programming', 'anglais', "Dans cette livre, l'accent est mis sur l'apprentissage rapide et efficace de JavaScript, en soulignant la pertinence et la polyvalence du langage pour le développement web.", '../static/pdf/livres/matlab-object-oriented-programming.pdf', '../static/img/livres/matlab-object-oriented-programming.jpg'),
(11,'Pratique De MySQL Et PHP ', 'français',"'MySQL et PHP pour des Sites Dynamiques' est plus qu'un simple manuel ; c'est un guide pratique qui vous accompagnera tout au long de votre parcours d'apprentissage, vous aidant à développer des sites web interactifs et performants. Préparez-vous à transformer vos idées en applications web concrètes grâce à la puissance combinée de PHP et MySQL.", '../static/pdf/livres/pratique-de-mysql-et-php-sites-dynamiques.pdf', '../static/img/livres/pratique-de-mysql-et-php-sites-dynamiques.png'),
(12,'Programmer En Java','français',"Programmation en Java est plus qu'un simple manuel ; c'est un guide complet qui vous accompagnera tout au long de votre parcours d'apprentissage, vous aidant à devenir un programmeur Java compétent et confiant. Préparez-vous à explorer les vastes possibilités offertes par Java et à transformer vos idées en applications concrètes grâce à ce langage puissant et flexible.", '../static/pdf/livres/programmer-en-java.pdf', '../static/img/livres/programmer-en-java.png'),
(13,'The Ruby Programming Language', 'anglais', 'Ce livre, The Ruby Programming Language, est un guide incontournable pour apprendre et maîtriser Ruby, un langage de programmation reconnu pour sa simplicité et sa puissance. Que vous soyez un débutant en programmation ou un développeur chevronné, ce livre vous fournira une compréhension complète des concepts de base et avancés de Ruby.', '../static/pdf/livres/The-Ruby-Programming-Language.pdf', '../static/img/livres/The-Ruby-Programming-Language.png');
CREATE TABLE ressources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    categorie VARCHAR(30) NOT NULL,
    niveau VARCHAR(40) NOT NULL,
    langue VARCHAR(20) NOT NULL,
    description TEXT,
    pdf VARCHAR(255) NOT NULL,
    nom_utilisateur VARCHAR(255) NOT NULL,
    CONSTRAINT fk_nom_utilisateur
    FOREIGN KEY (nom_utilisateur)
    REFERENCES etudiant(nom_utilisateur)
);
INSERT INTO `ressources` (`id`, `titre`, `categorie`, `niveau`, `langue`, `description`, `pdf`, `nom_utilisateur`) VALUES
(1, 'Algorithme semestre 3', 'cours', 'L2', 'français', 'Le cours &#34;Algorithmes - Deuxième Année&#34; approfondit la récursivité, la complexité algorithmique et les structures de données séquentielles et hiérarchiques, préparant les étudiants à résoudre des problèmes complexes en informatique. Prérequis : une compréhension de base de la programmation et des structures de données.', 'Algorithmesemestre3_6650a8d4210fe.pdf', 'leo_messi927'),
(2, 'Logique mathématique 1ére série semestre 3', 'td', 'L2', 'français', 'Cette série de travaux dirigés de Logique Mathématique explore divers aspects de la logique propositionnelle. Les exercices comprennent la traduction de propositions en langage courant, la manipulation de propositions avec des opérateurs logiques, la construction de tables de vérité, la résolution de problèmes de logique et l&#39;application de la logique propositionnelle à des scénarios pratiques. Ces exercices visent à renforcer les compétences en analyse logique, en raisonnement formel et en résolution de problèmes chez les étudiants.', 'Logiquemathmatique1resriesemestre3_6650aa92c02ca.pdf', 'leo_messi927'),
(3, 'Reseaux 1ére série semestre 4', 'tp', 'L2', 'français', 'Ce TP offre une combinaison d&#39;apprentissage théorique et pratique, permettant aux étudiants de mettre en pratique leurs connaissances sur les réseaux en construisant et en simulant un réseau local.', 'Reseaux1resriesemestre4_6650af2e0907f.pdf', 'user1_name1423'),
(4, 'Programmation Orientée Objet (Java) semestre 4', 'examen', 'L2', 'français', 'Cet examen de l&#39;année 2020/2021 est conçu pour tester la compréhension des concepts de base de la POO, y compris l&#39;héritage, les constructeurs, les méthodes statiques et les interfaces en Java.', 'ProgrammationOrienteObjetJavasemestre4_6650b0b24d905.pdf', 'user1_name1423'),
(5, 'Programmation linéaire chapitre 1 semestre 5', 'cours', 'L3', 'français', 'Ce chapitre aborde les concepts fondamentaux de la Programmation Linéaire (PL) et offre une introduction à la Recherche Opérationnelle (RO). Il s&#39;agit d&#39;un domaine de l&#39;optimisation mathématique qui se concentre sur la maximisation ou la minimisation d&#39;une fonction objective, sous certaines contraintes linéaires. Les rappels incluent les notions de base de la PL, telles que les systèmes d&#39;équations linéaires, les inégalités et les propriétés des solutions. L&#39;introduction à la RO couvre son rôle dans la prise de décisions optimales dans divers domaines comme l&#39;ingénierie, l&#39;économie, la gestion et la logistique. Ce chapitre établit les bases théoriques nécessaires pour comprendre et appliquer les méthodes de la PL et de la RO dans des situations pratiques.', 'Programmationlinairechapitre1semestre5_6650b627538b3.pdf', 'user2_name2604'),
(6, 'Système d&#39;exploitation semestre 5 -2016/2017-', 'examen', 'L3', 'français', 'Cet examen de l&#39;année 2016/2017 met à l&#39;épreuve les compétences des étudiants en programmation concurrente et en gestion des processus, des aspects cruciaux dans les systèmes d&#39;exploitation.', 'Systmed39exploitationsemestre5_6650b6d9dc08c.pdf', 'user2_name2604'),
(7, 'Compilation 1ére série semestre 5', 'td', 'L3', 'français', 'Cette série de TD se concentre sur la reconnaissance et l&#39;analyse lexicale de commentaires et d&#39;identificateurs en utilisant des automates finis déterministes (DFA), ainsi que sur la manipulation des expressions régulières. Elle est divisée en trois exercices principaux, chacun abordant un aspect fondamental de la compilation.', 'Compilation1resriesemestre5_6650b77bd52bb.pdf', 'user2_name2604'),
(8, 'Intelligence artificielle 1ére série  semestre 6', 'tp', 'L3', 'français', 'L&#39;objectif de ce tp est de renforcer les compétences en programmation Python à travers des exercices pratiques, tout en se familiarisant avec des bibliothèques couramment utilisées pour l&#39;analyse de données et la visualisation.', 'Intelligenceartificielle1resriesemestre6_6650b876088c5.pdf', 'user2_name2604');
CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  numero INT NOT NULL,
  message VARCHAR(500) NOT NULL
) 

