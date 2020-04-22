using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Builder_Pattern.Quack
{
    class SimpleQuack : IQuack
    {
        public void Quack()
        {
            Console.WriteLine("Quack - Quack");
        }
    }
}
