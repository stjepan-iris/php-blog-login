Finns en admin namn och lösen är admin samma med user namn och lösen är user.

Alla namn på functioner och variablar är skrivna i cammelCase. Nästan allt är skrivet i cammelCase.

Under views-mappen ligger allt som har med HTML på sidan att göra och allt som skrivs ut med HTML.
adminpost.php = som gör så att du skriver ett inlägg.
commentform = skriven en commentar.
editform = skriver om linägget.
signupform = gör ett konto.
writecomment = skriver ut kommentarer.
writepost = skriver ut inlägg.

Under Includes-mappen ligger allt som görs i backgrunden som användaren inte se på sidan.
adminposthandler = hanterar informationen från adminpost som användaren skriver in och lägger in det i databasen.
commenthandler =  hanterar informationen från commetsom användaren skriver in och lägger in det i databasen.
edithandler = hanterar informationen från editformen användaren skriver in och byter ut det som står i databasen.
login = kollar om man är user eller admin när man loggar in.
logginhandler = kollar om man är regristrerad användare.
logut = loggar ut användaren.
signuphandler = skriver in sigup regristrerings information in i databasen.

img-mappen sparar alla bilder som läggs upp från användaren.

classes-mappen innehåller alla classes som används på sidan.
	