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

        

        //this.apiURL = "https://cloud.iexapis.com/stable/tops?token=" + process.env.MIX_IEX_TOKEN + "&symbols=";
        //this.apiURL = 'https://crossorigin.me/https://finnhub.io/api/v1/quote?symbol=';
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
        if(event.target.name && event.target.value){
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
                
                this.setState({canSubmit:true});
            }            
        );
        
        
    }
    render(){     
        return(
            <div className="favorite-stocks-form">
                <form onSubmit={this.handleSubmit}>
                    <label>
                        Symbol: 
                        <input type="text" value={this.state[this.stockSymbolState]} name={this.stockSymbolState} onChange={this.handleChange}/>
        {this.state.canSubmit ? <button className="btn" disabled={!this.state.canSubmit}>Add Stock</button> : <div>Retrieving stock <span className="loader-element"></span></div> }
                    </label>
                    
                </form>
                {this.state.error ? <div>{this.state.error}</div> : ''}
            </div>
        )
    }
    
}

export default AddFavoriteStock;