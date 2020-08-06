import React, {useState, useEffect} from 'react';
import AddFavoriteStock from './add-favorite-stock';
import DisplayFavoriteStocks from './display-favorite-stocks';
import axios from 'axios';

class FavoriteStocks extends React.Component{
    constructor(props){
        super(props);

        this.state={
            stocks: [],
        }

        this.stocksAPI = '/api/favorite-stocks';
        this.addStock = this.addStock.bind(this);
        this.removeStock = this.removeStock.bind(this);
        this.updateStocks = this.updateStocks.bind(this);
    }

    async getStocks(){
        try{
            const response = await axios.get(this.stocksAPI);            
            return response.data;            
        } catch(e){
            console.error(e);
            return false;
        }
    }

    componentWillMount(){
        this.getStocks()
        .then( stockData => this.setState({stocks: stockData}) );
    }

    addStock(newStock){         
        const stocks = this.state.stocks;
        stocks.push(newStock);
        this.setState({stocks});
    }

    removeStock(stockId){
        const stocks = this.state.stocks;
        const stockIndex = stocks.findIndex(item => item.id == stockId);
        if(stockIndex >= 0){
            stocks.splice(stockIndex, 1);
            this.setState({stocks});
        }

    }

    updateStocks(stocks){
        this.setState({stocks});
    }

    render(){
        return (
            <div className="main-favorite-stocks-container">
                <AddFavoriteStock addStock={this.addStock} stocks={this.state.stocks}/> 
                <DisplayFavoriteStocks 
                    stocks={this.state.stocks} 
                    removeStock={this.removeStock} 
                    updateStocks={this.updateStocks}
                />
            </div>
        );
    }
    
}

export default FavoriteStocks;