import {elements} from './base';

function createReportId(year, month){
    return `monthly-report-${year}-${month}`;
}

function createCategoryReportId(year, month, category){
    return `monthly-category-report-${year}-${month}-${category}`;
}

async function getAnnualData(year){
    try{
        const result = await axios(`/api/reports/annual/${year}`);
        return result.data;
    } catch (e){
        console.error('axios', e);
    }
}

async function getMonthlyData(year, month, category = ''){
    try{
        const result = await axios(`/api/reports/monthly/${year}/${month}/${category}`);
        return result.data;
    } catch (e){
        console.error('axios', e);
    }
}

function annualReportView(year,data){
    function breakDownMonths(monthlyData){
        let monthData = '';

        for(let month in data[year].monthly){
            //get date
            let date = new Date(year, month - 1);
            const dateRegex = /([\w]+)\ (?<month>\w+)\ (?<day>\d+)/g;
            const monthName = dateRegex.exec(date.toDateString()).groups.month;

            //get expense percentage
            const expensePercentage = data[year].monthly[month].budget  ? ( (parseFloat(data[year].monthly[month].actuals)/parseFloat(data[year].monthly[month].budget)) * 100).toFixed(2): 'No budget set';

            //add the month data to var
            monthData += `<li class="month-data"><a class="month-link" href="#" title="retrieve ${monthName} data" data-month="${month}" data-year="${year}">${monthName} ${data[year].monthly[month].actuals}/${data[year].monthly[month].budget} (${expensePercentage}%)</a></li>`;
        }

        return `<div class="reports-annual-data">
                    <p>Year Total: $${data[year].actualsTotal} <br/>
                     Monthly Average: $${data[year].monthlyAverage}</p>
                    <ul class="monthly-list">${monthData}</ul>

                </div>`;

    }

    if('monthly' in data[year]) {
        return `<div id="annual-report-wrapper">${breakDownMonths(data[year].monthly)}</div>`;
    } else {
        return `<div id="annual-report-wrapper">No budget data found. Year actuals: ${data[year].actualsTotal}</div>`;
    }
}

function monthlyReportView(year, month, data){
    const id = createReportId(year, month);
    let categoryData = '';
    for(let category in data[year][month]){
        const expensePercentage = data[year][month][category].budget ? (parseFloat(data[year][month][category].actuals)/parseFloat(data[year][month][category].budget) * 100).toFixed(2) + "%" : 'No budget set'

        if(data[year][month][category].budget){
            categoryData += `<li class="category-data"><a class="category-link" href="#" title="retrieve ${data[year][month][category].name} data" data-category="${category}" data-year="${year}" data-month="${month}">${data[year][month][category].name} ${data[year][month][category].actuals}/${data[year][month][category].budget} (${expensePercentage})</a></li>`;
        } else{
            categoryData += `<li class="category-data">${data[year][month][category].name} ${data[year][month][category].actuals}/${data[year][month][category].budget} (${expensePercentage})</li>`;
        }

    }


    return `<div class="monthly-report" id="${id}"><ul>${categoryData}</ul></div>`;
}

function monthlyCategoryReportView(year, month, category, data){
    const id = createCategoryReportId(year, month, category);
    let categoryData = '';

    for(let subCategory in data[year][month][category]){
        const expensePercentage = data[year][month][category][subCategory].budget ? (parseFloat(data[year][month][category][subCategory].actuals)/parseFloat(data[year][month][category][subCategory].budget) * 100).toFixed(2) + "%" : 'No budget set'

        categoryData += `<div class="sub-category-data">${data[year][month][category][subCategory].name} ${data[year][month][category][subCategory].actuals}/${data[year][month][category][subCategory].budget} (${expensePercentage})</div>`;
    }

    return `<div class="monthly-category-report" id="${id}">${categoryData}</div>`;

}

export default {
    async getAnnualReport(year){
        try{
            const data = await getAnnualData(year);
            return annualReportView(year, data);
        } catch (e){
            console.error('fetch', e);
        }
    },

    async getMonthlyReport(year, month){
        try{
            const data = await getMonthlyData(year, month);
            return monthlyReportView(year, month, data);
        } catch (e){
            console.error('fetch', e);
        }
    },

    async getMonthlyCategoryReport(year, month, category){
        try{
            const data = await getMonthlyData(year, month, category);
            return monthlyCategoryReportView(year, month, category, data);
        } catch (e){
            console.error('fetch', e);
        }
    },

    getMonthlyID(year, month){
       return createReportId(year,month);
    },

    getMonthlyCategoryReportID(year, month, category){
        return createCategoryReportId(year, month, category);
    }
}


