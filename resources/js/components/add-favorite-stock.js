import React, {useState, useEffect} from 'react';
import axios from 'axios';



class AddFavoriteStock extends React.Component{
    constructor(props){
        super(props);

        this.stockSymbolState = 'stockSymbol';
        this.state = {
            [this.stockSymbolState]: '',
            canSubmit: true,
            error: '',
        };
    
        this.apiURL = '/api/getStock/'

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }


    async saveStock(name){
        try{
            const response = await axios.get(this.apiURL+name);      
            return response.data;
        } catch(e){
            console.error(e);
            return {error: 'Something went wrong.'}            
        }
    }

    handleChange (event) {
        if(event.target.name){
            this.setState({
                [event.target.name]: event.target.value
            })
        }       
    }

    handleSubmit(event){
        event.preventDefault();

        if(!this.state.canSubmit){
            return;
        }

        if(!this.state[this.stockSymbolState]){
            this.setState({
                error:'Error: empty symbol.'
            })
            return;
        }

        const symbol = this.state[this.stockSymbolState].toUpperCase();
        const repeated = this.props.stocks.findIndex( stock => stock.symbol == symbol);

        if(repeated != -1){
            this.setState({
                error: "Stock has already been added",
            })
            return;
        }

        //disable submission until process is ready and clear errors
        this.setState({
            canSubmit: false,
            error:''
        });

        this.saveStock(this.state[this.stockSymbolState])
        .then(
            async (newStock) => {
                if('symbol' in newStock){
                    this.props.addStock(newStock);
                } else if('error' in newStock){
                    this.setState({error: newStock.error})
                }  
                
                this.setState({
                    canSubmit:true,
                    [this.stockSymbolState]: '',
                });
            }            
        );
        
        
    }
    render(){     
        return(
            <div className="favorite-stocks-form">
                <form onSubmit={this.handleSubmit}>
                    <label>
                        Symbol: 
                        <input id="favorite-stock-input" type="text" placeholder="ex.GOOG" value={this.state[this.stockSymbolState]} name={this.stockSymbolState} onChange={this.handleChange}/>
        {this.state.canSubmit ? <button className="btn add-favorite-btn" disabled={!this.state.canSubmit}>Add</button> : <div>Retrieving stock <span className="loader-element"></span></div> }
                    </label>
                    
                </form>
                {this.state.error ? <div>{this.state.error}</div> : ''}
            </div>
        )
    }
    
}

export default AddFavoriteStock;