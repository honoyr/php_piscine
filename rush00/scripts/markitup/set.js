// -------------------------------------------------------------------
// markItUp!
// -------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// -------------------------------------------------------------------
// Mediawiki Wiki tags example
// -------------------------------------------------------------------
// Feel free to add more tags
// -------------------------------------------------------------------
var myWikiSettings = {
    onShiftEnter:       {keepDefault:false, replaceWith:'\n\n'},
    markupSet: [   
        {name:'Жирный', key:'B', openWith:"**", closeWith:"**"}, 
        {name:'Курсив', key:'I', openWith:"//", closeWith:"//"}, 
        {name:'Подчеркнутый', key:'U', openWith:'__', closeWith:'__'},
        {separator:'---------------' },
        {name:'Цвета', className:'palette', dropMenu: [
                {openWith:'##FCE94F|', closeWith:"##",  className:"col1-1" },
                {openWith:'##EDD400|', closeWith:"##",  className:"col1-2" },
                {openWith:'##C4A000|', closeWith:"##",  className:"col1-3" },
                
                {openWith:'##FCAF3E|', closeWith:"##",  className:"col2-1" },
                {openWith:'##F57900|', closeWith:"##",  className:"col2-2" },
                {openWith:'##CE5C00|', closeWith:"##",  className:"col2-3" },
                
                {openWith:'##E9B96E|', closeWith:"##",  className:"col3-1" },
                {openWith:'##C17D11|', closeWith:"##",  className:"col3-2" },
                {openWith:'##8F5902|', closeWith:"##",  className:"col3-3" },
                
                {openWith:'##8AE234|', closeWith:"##",  className:"col4-1" },
                {openWith:'##73D216|', closeWith:"##",  className:"col4-2" },
                {openWith:'##4E9A06|', closeWith:"##",  className:"col4-3" },
                
                {openWith:'##729FCF|', closeWith:"##",  className:"col5-1" },
                {openWith:'##3465A4|', closeWith:"##",  className:"col5-2" },
                {openWith:'##204A87|', closeWith:"##",  className:"col5-3" },
    
                {openWith:'##AD7FA8|', closeWith:"##",  className:"col6-1" },
                {openWith:'##75507B|', closeWith:"##",  className:"col6-2" },
                {openWith:'##5C3566|', closeWith:"##",  className:"col6-3" },
                
                {openWith:'##EF2929|', closeWith:"##",  className:"col7-1" },
                {openWith:'##CC0000|', closeWith:"##",  className:"col7-2" },
                {openWith:'##A40000|', closeWith:"##",  className:"col7-3" },
                
                {openWith:'##FFFFFF|', closeWith:"##",  className:"col8-1" },
                {openWith:'##D3D7CF|', closeWith:"##",  className:"col8-2" },
                {openWith:'##BABDB6|', closeWith:"##",  className:"col8-3" },
                
                {openWith:'##888A85|', closeWith:"##",  className:"col9-1" },
                {openWith:'##555753|', closeWith:"##",  className:"col9-2" },
                {openWith:'##000000|', closeWith:"##",  className:"col9-3" }
            ]
        }, 
        {separator:'---------------' },
        {name:'Неупорядоченный список', openWith:'(!(* |!|*)!)'}, 
        {name:'Нумерованный список', openWith:'(!(# |!|#)!)'}, 
        {separator:'---------------' },
        {name:'Изображение', key:"P", replaceWith:'[[![Ссылка на изображение:!:http://]!] [![name]!]]'}, 
        {name:'Ссылка', openWith:"[[![Ссылка:!:http://]!] ", closeWith:']', placeHolder:'Здесь текст ссылки...' },
        {name:'Генератор таблиц', 
            className:'tablegenerator', 
            placeholder:"Текст сюда...",
            replaceWith:function(h) {
                cols = prompt("Сколько столбцов?");
                rows = prompt("Сколько строк?");
                html = "\n";
                if (h.altKey) {
                    for (c = 0; c < cols; c++) {
                        html += "! [![TH"+(c+1)+" text:]!]\n";  
                    }   
                }
                for (r = 0; r < rows; r++) {
                    html+= "|";
                    for (c = 0; c < cols; c++) {
                        html += "| "+(h.placeholder||"")+" |";  
                    }
                    html+= "|\n";
                }
                html+= "\n";
                return html;
            }
        }, 
        {separator:'---------------' },
        {name:'Цитата', openWith:'(!(> |!|>)!)'},
        {name:'Код', openWith:'(!(\n<code lang="[![Language:!:php]!]">\n|!|<pre>)!)', closeWith:'(!(\n</code>|!|</pre>)!)'} 
    ]
}