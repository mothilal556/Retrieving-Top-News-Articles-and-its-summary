import sys
import requests	
import nltk
from textblob import TextBlob
from newspaper import Article

api_key ="3f6b0c50225f4b4cb208683983772d83"

def summarize(link):
    url = "https://www.reuters.com/world/asia-pacific/six-killed-firing-by-afghan-forces-pakistan-border-pakistan-army-2022-12-11/"
    article = Article(url)
    article.download()
    article.parse()
    article.nlp()

    analysis=TextBlob(article.text)

    data = [analysis.polarity,article.publish_date,article.summary]
    return data
    
def news(c):
    main_url = "https://newsapi.org/v2/top-headlines?country=in&apiKey="+api_key
    news = requests.get(main_url).json()
    article = news["articles"]

    for i in range(0,c):
        title = article[i]["title"]
        url = article[i]["url"]
        data = summarize(url)
        print("<br/><button type='button' class='btn btn-primary' data-toggle='collapse' data-target='#demo{0}'>+ <b>{1}</b></button>".format(i+1,title))
        print("<div id='demo{0}' class='collapse show'>".format(i+1))
        print("Published Date: {0} <br/> {1}<br/>".format(data[1],data[2]))
        print("<a href='{0}' target='_blank'>View Full Article</a>".format(url))
        print("</div><br/>")
        
        
     
news(int(sys.argv[1]))
