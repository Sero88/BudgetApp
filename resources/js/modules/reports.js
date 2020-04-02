import {elements} from './base';



async function getAnnualData(year){
    try{
        const result = await axios(`/api/reports/annual/${year}`);
        return result.data;
    } catch (e){
        console.error('axios', e);
    }
}


async function getMonthlyData(year, month){
    try{
        const result = await axios(`/api/reports/monthly/${year}/${month}`);
        return result.data;
    } catch (e){
        console.error('axios', e);
    }
}

function annualReportView(year,data){
    function breakDownMonths(monthlyData){
        let monthData = '';
        console.log('monthly is not empty');

        for(let month in data[year].monthly){
            //get date
            let date = new Date(year, month - 1);
            const dateRegex = /([\w]+)\ (?<month>\w+)\ (?<day>\d+)/g;
            const monthName = dateRegex.exec(date.toDateString()).groups.month;

            //get expense percentage
            const expensePercentage = data[year].monthly[month].budget  ? (parseInt(data[year].monthly[month].actuals, 10)/parseInt(data[year].monthly[month].budget, 10) * 100).toFixed(2): 'No budget set';

            //add the month data to var
            monthData += `<div class="month-data"><a class="month-link" href="#" title="retrieve ${monthName} data" data-month="${month}" data-year="${year}">${monthName} ${data[year].monthly[month].actuals}/${data[year].monthly[month].budget} (${expensePercentage}%)</a></div>`;
        }

        return monthData;

    }

    if('monthly' in data[year]) {
        return `<div id="annual-report-wrapper">${breakDownMonths(data[year].monthly)}</div>`;
    } else {
        return `<div id="annual-report-wrapper">No budget data found. Year actuals: ${data[year].actualsTotal}</div>`;
    }
}

function createReportId(year, month){
    return `monthly-report-${year}-${month}`;
}


function monthlyReportView(year, month, data){
    console.log(data);
    const id = createReportId(year, month);
    let categoryData = '';
    for(let category in data[year][month]){
        console.log(data[year][month][category].actuals);
        const expensePercentage = data[year][month][category].budget ? data[year][month][category].actuals/data[year][month][category].budget + "%" : 'No budget set'
        categoryData += `<div class="category-data"><a class="category-link" href="#" title="retrieve ${category} data" data-category="${category}">${category} ${data[year][month][category].actuals}/${data[year][month][category].budget} (${expensePercentage})</a></div>`;
    }


    return `<div class="monthly-report" id="${id}">${categoryData}</div>`; //todo next  - build this report
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

    getMonthlyID(year, month){
       return createReportId(year,month);
    }
}


