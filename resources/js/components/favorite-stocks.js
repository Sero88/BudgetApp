import React, {useState, useEffect} from 'react';
import AddFavoriteStock from './add-favorite-stock.js';

class FavoriteStocks extends React.Component{
    constructor(props){
        super(props);

        this.state={
            stocks: [],
        }


        this.updateStocks = this.updateStocks.bind(this);
    }

    updateStocks(stocks){            

    }

    render(){
        return (
            <div className="main-favorite-stocks-container">
                <AddFavoriteStock updateStocks={this.updateStocks()}/>
            </div>
        );
    }
    
}

export default FavoriteStocks;