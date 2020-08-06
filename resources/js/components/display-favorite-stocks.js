import React from 'react';
import axios from 'axios';

function SortingButton(props){

    const sortArrowClass = props.sorting.order == 'desc' ? ' fas fa-angle-down' : ' fas fa-angle-up';
    return (
        <button 
            className="settings-button"
            name={props.name} 
            onClick={props.handleChange}
        >
            {props.children} {props.sorting.active == props.name ? <span className={"active-setting"+sortArrowClass}></span> : ''}
        </button>
        
    );
}

function SortSettings(props){
    
    return (
        <div className="sort-settings-container">
            <SortingButton 
                name="name"
                handleChange={props.handleChange}
                sorting={props.sorting}                
            >Name
            </SortingButton>

            <SortingButton
                name="price"
                handleChange={props.handleChange}
                sorting={props.sorting}  
            >Price
            </SortingButton>
                        
        </div>
    );
}

function Favorite(props){
    return(
        <div className="favorite-stock">           
            <div className="stock-card-header">
                <p>{props.symbol}</p>
                <button onClick={props.removeFavorite}><span data-stockid={props.stockId} className="fas fa-window-close"></span></button>
            </div>

            <div className="stock-card-body">        
                <p>${props.price}</p>
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
            return response.data;
        } catch(e){
            console.error(e);
            return 'Error deleting favorite stock';
        }

    }

    sortSettingChange(event){
        event.preventDefault();
        const button = event.target.closest('.settings-button');

        const active = button.name;
        const order = active != this.state.sorting.active || this.state.sorting.order == 'asc' ? 'desc' : 'asc'; 
        let stocks = this.props.stocks; 

        switch(active){
            case 'name':
                stocks = sortStocksByName(this.props.stocks, order);
                break;

            case 'price':
                stocks = sortStocksByPrice(this.props.stocks, order);
                break;                            
        }

        this.props.updateStocks(stocks);

        this.setState({
            sorting: {active, order}
        })
        
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
            <div className="display-favorites-container">      
                Sort: <SortSettings 
                    handleChange={this.sortSettingChange}                     
                    sorting={this.state.sorting}                     
                />
                <div className="favorites-container" >
                    {favorites}          
                </div>
            </div>
        );
    }
}

function sortStocksByName(stocks, order){

    if(order == 'asc'){
        stocks.sort( (a, b) => {        
            return a.symbol < b.symbol ? -1 : 1;
        });
    } else{
        stocks.sort( (a, b) => {        
            return a.symbol > b.symbol ? -1 : 1;
        });
    }

    return stocks;
}


function sortStocksByPrice(stocks, order){
    if(order == 'asc'){
        stocks.sort( (a, b) => {        
            return a.price - b.price;
        });
    } else{
        stocks.sort( (a, b) => {        
            return b.price - a.price;
        });
    }

    return stocks;
}

export default DisplayFavorites;