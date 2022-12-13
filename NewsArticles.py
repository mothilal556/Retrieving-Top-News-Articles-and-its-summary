import sys
import requests	
import nltk
from textblob import TextBlob
from newspaper import Article

api_key ="3f6b0c50225f4b4cb208683983772d83"

def summarize(link):
    article = Article(link)
    article.download()
    article.parse()
    article.nlp()

    analysis=TextBlob(article.text)

    data = [analysis.polarity,article.publish_date,article.summary]
    return data
    
def news(keyword,category,count,fromdate,todate):
    main_url = "None"
    if keyword=="None" and category=="None":
        main_url = "https://newsapi.org/v2/top-headlines?country=in&from={0}&to={1}&apiKey={2}".format(fromdate,todate,api_key)
    elif keyword=="None" and category!="None":
        main_url = "https://newsapi.org/v2/top-headlines?country=in&from={0}&to={1}&category={2}&apiKey={3}".format(fromdate,todate,category,api_key)
    elif category=="None" and keyword!="None":
        main_url = "https://newsapi.org/v2/top-headlines?country=in&from={0}&to={1}&keyword={2}&apiKey={3}".format(fromdate,todate,keyword,api_key)
    else:
        main_url = "https://newsapi.org/v2/top-headlines?country=in&from={0}&to={1}&keyword={2}&category={3}&apiKey={4}".format(fromdate,todate,keyword,category,api_key)
    
    news = requests.get(main_url).json()
    article = news["articles"]
    
    for i in range(0,count):
        title = article[i]["title"]
        url = article[i]["url"]
        data = summarize(url)
        
        print("<br/><button type='button' class='btn btn-primary' data-toggle='collapse' data-target='#demo{0}'>+ <b>{1}</b></button>".format(i+1,title))
        print("<div id='demo{0}' class='collapse show'>".format(i+1))
        print("<b>Published Date:</b> {0} <br/> {1}<br/>".format(data[1],data[2]))
        print("<a href='{0}' target='_blank'>View Full Article</a>".format(url))
        print("</div><br/>")
     
news(sys.argv[1], sys.argv[2], int(sys.argv[3]), sys.argv[4], sys.argv[5])
