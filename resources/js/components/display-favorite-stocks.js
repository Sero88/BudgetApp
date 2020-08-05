import React from 'react';
import axios from 'axios';

function SortSettings(props){
    
    return (
        <div className="sort-settings-container">
            <button name="name" onClick={props.handleChange}>Name{props.sorting.active == 'name' ? <span class="active-setting"></span> : ''}</button>
            <button name="price" onClick={props.handleChange}>Price{props.sorting.active == 'price' ? <span class="active-setting"></span> : ''}</button>
        </div>
    );
}

function Favorite(props){
    return(
        <div className="favorite">
            <div className="stock-card">
                <div className="stock-card-header">
                    <p>{props.symbol}</p>
                    <button data-stockid={props.stockId} onClick={props.removeFavorite}>x</button>
                </div>

                <div className="stock-card-body">        
                    <p>{props.price}</p>
                </div>
            </div>
        </div>
    );
}

class DisplayFavorites extends React.Component{
    constructor(props){
        super(props);        

        this.state = {
            sorting: {active: '', order: ''}
        }

        this.apiURL = '/api/favorite-stocks/';
        this.handleRemove = this.handleRemove.bind(this);
        this.sortSettingChange = this.sortSettingChange.bind(this);
    }

    async removeFavorite(stockId){
        try{
            const response = await axios.delete(this.apiURL + stockId);
            console.log('after delete: ' , response.data)
            return response.data;
        } catch(e){
            console.error(e);
            return 'Error deleting favorite stock';
        }

    }

    sortSettingChange(event){
        event.preventDefault();
        console.log(event.target.name);
    }

    handleRemove(event){
        const stockId = event.target.dataset.stockid;
        this.removeFavorite(stockId)
        .then( response => {this.props.removeStock(stockId)} )
        .catch( e => console.error(e));
    }

    render(){
        let favorites;
       
        if(this.props.stocks.length > 0){
            favorites = this.props.stocks.map( (stock,index) => {
                return (
                    <Favorite 
                        key={index} 
                        price={stock.price} 
                        symbol={stock.symbol} 
                        stockId={stock.id} 
                        removeFavorite={this.handleRemove}
                    />);
            });
        }

        return(
            <div className="stock-favorites-container">      
                <SortSettings 
                    handleChange={this.sortSettingChange} 
                    sorting={this.state.sorting} 
                />
                {favorites}          
            </div>
        );
    }
}

export default DisplayFavorites;